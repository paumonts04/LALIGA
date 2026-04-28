<?php
require_once 'conexion.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit(); // Si no se ha iniciado sesion te redirige al login
}

require_once 'header.php';

$id_equipo = isset($_GET['id']) ? (int)$_GET['id'] : 0; //Si no existe el id entonces sera 0

$datos_equipo = null;
if ($id_equipo > 0) {
    $sql_equipo = "SELECT equipo, escudo FROM equipos WHERE id_equipo = $id_equipo";
    $res_equipo = $con->query($sql_equipo);
    $datos_equipo = $res_equipo->fetch_assoc();
}
?>

<nav class="equipos-nav-bar">
    <div class="nav-bar-flex"> <?php
        $sql_nav = "SELECT id_equipo, equipo, escudo FROM equipos";
        $res_nav = $con->query($sql_nav);
        
        if ($res_nav && $res_nav->num_rows > 0):
            while ($equipo_nav = $res_nav->fetch_assoc()):
                $active_class = ($id_equipo == $equipo_nav['id_equipo']) ? 'active' : ''; // Si el id del equipo coincide con el equipo seleccionado, entonces la clase pasa a ser active (ver el css)
        ?>
            <a href="jugadores.php?id=<?php echo $equipo_nav['id_equipo']; ?>" 
               class="nav-equipo-item <?php echo $active_class; ?>">
                <img src="/LALIGA/img/escudos/<?php echo $equipo_nav['escudo']; ?>" alt="<?php echo $equipo_nav['equipo']; ?>"> <!--El alt en realidad no hace falta, es solo por si la imagen falla -->
                <span class="nav-equipo-nombre"><?php echo $equipo_nav['equipo']; ?></span>
            </a>
        <?php 
            endwhile;
        endif; 
        ?>
    </div>
</nav>

<main class="content-wrapper">
    <div class="cabecera-plantilla">
        <div class="info-titulo-equipo">
            <?php if ($datos_equipo): ?>
                <img src="/LALIGA/img/escudos/<?php echo $datos_equipo['escudo']; ?>" class="mini-escudo">
                <h1><?php echo $datos_equipo['equipo']; ?> <small>| Plantilla</small></h1>
            <?php else: ?>
                <h1>Todos los Jugadores</h1>
            <?php endif; ?>
        </div>
        <a href="equipos.php" class="btn-volver">← Volver</a>
    </div>

    <div class="grid-jugadores">
    <?php
    // 1. Definimos la base de la consulta
    $sql = "SELECT j.*, e.equipo AS nombre_club 
            FROM jugadores j 
            INNER JOIN equipos e ON j.id_equipo = e.id_equipo";

    //Añadimos el filtro si existe un equipo seleccionado
    if ($id_equipo > 0) {
        // Es necesario el espacio antes de WHERE
        $sql .= " WHERE j.id_equipo = $id_equipo"; 
    }

    //Añadimos el orden final
    $sql .= " ORDER BY j.id ASC";

    //Ejecutamos
    $res = $con->query($sql); 

    if ($res && $res->num_rows > 0) {
        while ($jug = $res->fetch_assoc()) {
            // Construimos la ruta dinámica: /LALIGA/img/Jugadores/Nombre Del Equipo/nombre_imagen.png
            $carpeta_equipo = $jug['nombre_club'];
            $nombre_archivo = !empty($jug['img']) ? $jug['img'] : 'profile_image.jpg';
            
            $ruta_foto = "/LALIGA/img/Jugadores/" . $carpeta_equipo . "/" . $nombre_archivo;
            ?>
            <div class="jugador-card">
                <div class="foto-jugador-container">
                    <img src="<?php echo $ruta_foto; ?>" 
                         alt="<?php echo $jug['nombre']; ?>"
                         onerror="this.src='/LALIGA/img/Jugadores/profile_image.jpg';">
                    <span class="nacionalidad-flag"><?php echo $jug['nacionalidad']; ?></span>
                </div>
                
                <div class="jugador-info">
                    <span class="posicion-label"><?php echo $jug['posicion']; ?></span>
                    <h3><?php echo $jug['nombre']; ?></h3>
                    <p class="edad-texto"><?php echo $jug['edad']; ?> años</p>
                    
                    <div class="stats-row">
                        <div class="stat-item">
                            <span class="stat-val"><?php echo $jug['goles']; ?></span>
                            <span class="stat-lab">Goles</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-val"><?php echo number_format($jug['salario'], 0, ',', '.'); ?>€</span>
                            <span class="stat-lab">Sueldo</span>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        echo "<p>No hay jugadores en este equipo.</p>";
    }
    ?>
</div>
</main>