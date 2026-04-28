<?php
// Incluimos la conexión
require_once 'conexion.php'; 

// Si ya hay una sesión iniciada, mandamos al usuario directo a la zona privada
if (isset($_SESSION['usuario_id'])) {
    header("Location: principal.php");
    exit();
}

$error_login = ""; //Iniciamos variable

//Procesamos el formulario al pulsar "Ingresar"
if (isset($_POST['ingresar'])) {
    // Escapamos los datos básicos para evitar errores con comillas
    $user = $_POST['nombre_usuario'];
    $pass = $_POST['password'];

    $sql = "SELECT id, nombre_usuario FROM usuarios 
            WHERE nombre_usuario = '$user' AND password = '$pass'";
    
    $resultado = $con->query($sql);

    if ($resultado && $resultado->num_rows > 0) {
        $datos = $resultado->fetch_assoc();
        
        // GUARDAR SESIÓN: Usamos el nombre de columna correcto que devuelve el SELECT
        $_SESSION['usuario_id'] = $datos['id']; 
        $_SESSION['nombre_usuario'] = $datos['nombre_usuario'];
        
        header("Location: equipos.php");
        exit();
    } else {
        $error_login = "Usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Samu Stats</title>
    <link rel="stylesheet" href="../css/style.css"> 
</head>
<body class="login-body">

    <div class="form-wrapper">
        <div class="form-container">
            <div style="text-align: center;">
                <img src="../img/logo.png" alt="Logo STATIUM" style="max-height: 90px;">
            </div>

            <h2>Acceso a la Liga</h2>
            <p>Introduce tus credenciales para continuar.</p>

            <?php if ($error_login != ""): ?>
                <div style="color: #e63946; background: #fff5f5; padding: 12px; border-radius: 6px; margin-bottom: 20px; border: 1px solid #e63946; font-size: 0.9rem; text-align: center;">
                    <strong>Error:</strong> <?php echo $error_login; ?>
                </div>
            <?php endif; ?>

            <form action="login.php" method="POST">
                <div class="form-group">
                    <label for="nombre_usuario">Nombre de Usuario</label>
                    <input type="text" id="nombre_usuario" name="nombre_usuario" placeholder="Tu usuario..." required>
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <div class="input-password-container">
                        <input type="password" id="password" name="password" placeholder="Tu contraseña..." required>
                        <img src="../img/ojo_cerrado.png" id="ojo" alt="Mostrar" class="icono-ojo">
                    </div>
                </div>

                <button type="submit" name="ingresar" class="btn-submit">Entrar al Sistema</button>
            </form>

            <div class="form-footer" style="margin-top: 25px; text-align: center; border-top: 1px solid #eee; padding-top: 15px;">
                <p>¿Eres nuevo? <a href="registro.php" style="color: #1a2a6c; font-weight: bold; text-decoration: none;">Crea una cuenta</a></p>
                <p style="margin-top: 8px;"><a href="../index.php" style="color: #888; font-size: 0.85rem;">← Volver a la página principal</a></p>
            </div>
        </div>
    </div>
    <script src="../js/ojete.js"></script>
</body>
</html>