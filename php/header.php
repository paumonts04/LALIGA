<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Samu Stats - LFP</title>
    <link rel="stylesheet" href="/LALIGA/css/style.css?v=<?php echo time(); ?>"> <!--Si no meto esto no me lee el css por la ruta (el navegador descarga el css cada vez)-->
</head>
<body>

<header class="main-header">
    <div class="header-container">
        <div class="logo">
            <a href="/LALIGA/index.php">
                <img src="/LALIGA/img/logo.png" alt="STATIUM LALIGA">
            </a>
        </div>

        <nav class="nav-menu">
            <?php if (isset($_SESSION['usuario_id'])): ?> <!--Comprobamos si se ha iniciado sesion -->
                <div class="nav-logueado-container">
                    <span class="saludo-usuario">
                        Hola, <strong><?php echo $_SESSION['nombre_usuario']; ?></strong>
                    </span>
                    
                    <ul class="lista-nav">
                        <li><a href="/LALIGA/php/equipos.php" class="btn-nav">Equipos</a></li>
                        <li><a href="/LALIGA/php/jugadores.php" class="btn-nav">Jugadores</a></li>
                        <li><a href="/LALIGA/php/jornadas.php" class="btn-nav">Jornadas</a></li>
                        <li><a href="/LALIGA/php/clasificacion.php" class="btn-nav btn-logout">Clasificación</a></li>
                        <li><a href="/LALIGA/php/logout.php" class="btn-nav btn-logout">Cerrar Sesión</a></li>

                    </ul>
                </div>
            <?php else: ?>
                <div class="nav-botones">
                    <a href="/LALIGA/php/login.php" class="btn-nav">Iniciar Sesión</a>
                    <a href="/LALIGA/php/registro.php" class="btn-nav btn-registro">Registrarse</a>
                </div>
            <?php endif; ?>
        </nav>
    </div>
</header>