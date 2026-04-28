<?php
require_once 'conexion.php'; 

if (isset($_POST['registrar'])) {
    $user = $_POST['nombre_usuario'];
    $pass = $_POST['password'];
    $email = $_POST['email'];
    $equipo_post = $_POST['id_equipo_fav'];
    $suscripcion = $_POST['suscripcion'];

    // LÓGICA PARA "ME GUSTAN TODOS":
    // Si elige "todos", en SQL usamos NULL (sin comillas)
    // Si elige un ID, lo usamos con comillas.
    if ($equipo_post == "todos" || empty($equipo_post)) {
        $equipo_final = "NULL";
    } else {
        $equipo_final = "'$equipo_post'";
    }

    $sql = "INSERT INTO usuarios (nombre_usuario, password, email, id_equipo_fav, precio_suscripcion) 
            VALUES ('$user', '$pass', '$email', $equipo_final, '$suscripcion')";

    if ($con->query($sql)) {
        echo "<script>alert('¡Registro exitoso!'); window.location='login.php';</script>";
    } else {
        $error = "Error de base de datos: " . $con->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - STATIUM</title>
    <link rel="stylesheet" href="../css/style.css"> </head>
<body class="registro-body">

    <div class="form-wrapper">
        <div class="form-container">
            <h2>Crea tu cuenta</h2>
            
            <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

            <form action="registro.php" method="POST">
                
                <div class="form-group">
                    <label>Usuario</label>
                    <input type="text" name="nombre_usuario" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>

                <div class="form-group">
                    <label>Contraseña</label>
                    <div class="input-password-container">
                        <input type="password" name="password" id="password" required>
                        <img class= "icono-ojo" id="ojo" src="../img/ojo_cerrado.png"/>
                    </div>
                </div>

                <div class="form-group">
                    <label>Tu Equipo Favorito</label>
                    <select name="id_equipo_fav" required>
                        <option value="">Selecciona una opción</option>
                        <option value="todos">Me gustan todos</option>
                        <?php
                        $res = $con->query("SELECT id_equipo, equipo FROM equipos");
                        while ($f = $res->fetch_assoc()) {
                            echo "<option value='".$f['id_equipo']."'>".$f['equipo']."</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Plan de Suscripción</label>
                    <div class="contenedor-planes-registro">
                        <input type="radio" name="suscripcion" value="0" id="p0" required>
                        <label for="p0" class="tarjeta-plan">
                            <span class="plan-titulo">GRATIS</span>
                            <span class="plan-precio">0€</span>
                        </label>

                        <input type="radio" name="suscripcion" value="10" id="p10">
                        <label for="p10" class="tarjeta-plan">
                            <span class="plan-titulo">ESTÁNDAR</span>
                            <span class="plan-precio">10€</span>
                        </label>

                        <input type="radio" name="suscripcion" value="15" id="p15">
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