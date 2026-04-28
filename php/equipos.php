<?php
// 1. Conexión y sesión (asumiendo que conexion.php tiene el session_start)
require_once 'conexion.php';

// 2. Seguridad: Si no hay sesión, al login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

// 3. Incluimos el header que ya tiene los botones nuevos y el nombre de usuario
require_once 'header.php'; 
?>

<main class="content-wrapper">
    <div class="titulo-pagina">
        <h1>Clubes de la Liga</h1>
        <p>Información oficial y puntos actualizados de los equipos.</p>
    </div>

<div class="grid-equipos">
    <?php
    //Añadimos 'escudo' a la consulta
    $sql = "SELECT id_equipo, equipo, estadio, puntos, escudo FROM equipos ORDER BY id_equipo ASC";
    $res = $con->query($sql);

    if ($res && $res->num_rows > 0) {
        while ($fila = $res->fetch_assoc()) {
            //Leemos el nombre del archivo directamente de la base de datos
            $nombre_imagen = !empty($fila['escudo']) ? $fila['escudo'] : 'default.png'; //Si no existe la foto mete una default
            $ruta_completa = "/LALIGA/img/Escudos/" . $nombre_imagen;
            ?>
            <div class="equipo-card">
                <a href="/LALIGA/php/jugadores.php?id=<?php echo $fila['id_equipo']; ?>" class="main-link"></a>

                <div class="card-header">
                    <div class="puntos-badge">
                        <?php echo $fila['puntos']; ?> <small>PTS</small>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="escudo-container">
                        <img src="<?php echo $ruta_completa; ?>" alt="Escudo de <?php echo $fila['equipo']; ?>">
                    </div>

                    <h2 class="nombre-equipo"><?php echo $fila['equipo']; ?></h2>
                    <p class="info-estadio">🏟️ <?php echo $fila['estadio']; ?></p>
                </div>
                
            </div>
            <?php
        }
    }
    ?>
</div>
</main>

<?php 

require_once 'footer.php'; 
?>