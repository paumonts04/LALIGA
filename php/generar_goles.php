
<?php
require_once 'conexion.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$sqlUpdate = "UPDATE jugadores SET goles = FLOOR(RAND() * 51)";
if (!$con->query($sqlUpdate)) {
    die("Error al generar goles: " . $con->error);
}

header("Location: clasificacion.php");
exit();
?>
