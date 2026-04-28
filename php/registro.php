<?php
require_once 'conexion.php'; 

$errores = []; // Iniciamos el array de errores

if (isset($_POST['registrar'])) {
    $user = trim($_POST['nombre_usuario']);
    $pass = $_POST['password']; 
    $email = trim($_POST['email']); 
    $equipo_post = $_POST['id_equipo_fav'];
    $suscripcion = $_POST['suscripcion'];

    // VALIDACIONES

    // Nombre de usuario
    if (empty($user)){
        $errores[] = "El nombre de usuario no puede estar vacío.";
    } else if (strlen($user) < 2 || strlen($user) > 40) {
        $errores[] = "La longitud del nombre debe ser de 2 a 40 caracteres.";
    }

    // Email
    if (empty($email)) {
        $errores[] = "Introduce tu correo electrónico.";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El correo electrónico introducido no es válido.";
    }

    // Contraseña
    if (strlen($pass) < 6) {
        $errores[] = "La contraseña debe tener 6 caracteres como mínimo.";
    }
    if (!preg_match('/[A-Z]/', $pass)) {
        $errores[] = "La contraseña debe contener alguna mayúscula.";
    }
    if (!preg_match('/[a-z]/', $pass)) {
        $errores[] = "La contraseña debe contener alguna minúscula.";
    }
    if (!preg_match('/[0-9]/', $pass)) {
        $errores[] = "La contraseña debe contener algún número.";
    }
    if (!preg_match('/[^A-Za-z0-9]/', $pass)) {
        $errores[] = "La contraseña debe contener algún carácter especial.";
    }

    if (empty($errores)) {

        $pass_hashed = password_hash($pass, PASSWORD_DEFAULT);

        if ($equipo_post == "todos" || empty($equipo_post)) {
            $equipo_final = null;
        } else {
            $equipo_final = $equipo_post;
        }

        $stmt = $con->prepare("INSERT INTO usuarios (nombre_usuario, password, email, id_equipo_fav, precio_suscripcion) VALUES (?, ?, ?, ?, ?)");

        if ($stmt) {

            $stmt->bind_param("sssii", $user, $pass_hashed, $email, $equipo_final, $suscripcion);

            if ($stmt->execute()) {
                echo "<script>alert('¡Registro exitoso!'); window.location='login.php';</script>";
                exit();
            } else {
                $errores[] = "Error de base de datos: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $errores[] = "Error al preparar la consulta: " . $con->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - STATIUM</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="registro-body">

    <div class="form-wrapper">
        <div class="form-container">
            <h2>Crea tu cuenta</h2>
            
            <?php if (!empty($errores)): ?>
                <div style="color: #e63946; background: #fff5f5; padding: 12px; border-radius: 6px; margin-bottom: 20px; border: 1px solid #e63946; font-size: 0.9rem; text-align: center;">
                    <ul style="margin: 0; padding-left: 20px;">
                        <?php foreach ($errores as $err): ?>
                            <li><?php echo $err; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="registro.php" method="POST">
                
                <div class="form-group">
                    <label>Usuario</label>
                    <input type="text" name="nombre_usuario" value="<?php echo isset($user) ? $user : ''; ?>" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>" required>
                </div>

                <div class="form-group">
                    <label>Contraseña</label>
                    <div class="input-password-container">
                        <input type="password" name="password" id="password" required>
                        <img class="icono-ojo" id="ojo" src="../img/ojo_cerrado.png"/>
                    </div>
                </div>

                <div class="form-group">
                    <label>Tu Equipo Favorito</label>
                    <select name="id_equipo_fav" required>
                        <option value="">Selecciona una opción</option>
                        <option value="todos" <?php if(isset($equipo_post) && $equipo_post == 'todos') echo 'selected'; ?>>Me gustan todos</option>
                        <?php
                        $res = $con->query("SELECT id_equipo, equipo FROM equipos");
                        while ($f = $res->fetch_assoc()) {
                            $selected = (isset($equipo_post) && $equipo_post == $f['id_equipo']) ? 'selected' : '';
                            echo "<option value='".$f['id_equipo']."' $selected>".$f['equipo']."</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Plan de Suscripción</label>
                    <div class="contenedor-planes-registro">
                        <input type="radio" name="suscripcion" value="0" id="p0" required <?php if(isset($suscripcion) && $suscripcion == '0') echo 'checked'; ?>>
                        <label for="p0" class="tarjeta-plan">
                            <span class="plan-titulo">GRATIS</span>
                            <span class="plan-precio">0€</span>
                        </label>

                        <input type="radio" name="suscripcion" value="10" id="p10" <?php if(isset($suscripcion) && $suscripcion == '10') echo 'checked'; ?>>
                        <label for="p10" class="tarjeta-plan">
                            <span class="plan-titulo">ESTÁNDAR</span>
                            <span class="plan-precio">10€</span>
                        </label>

                        <input type="radio" name="suscripcion" value="15" id="p15" <?php if(isset($suscripcion) && $suscripcion == '15') echo 'checked'; ?>>
                        <label for="p15" class="tarjeta-plan">
                            <span class="plan-titulo">PREMIUM</span>
                            <span class="plan-precio">15€</span>
                        </label>
                    </div>
                </div>

                <button type="submit" name="registrar" class="btn-submit">Registrarme</button>
            </form>
            
            <div class="form-footer">
                <a href="../index.php">Volver al inicio</a>
            </div>
        </div>
    </div>
<script src="../js/ojete.js"></script>
</body>
</html>