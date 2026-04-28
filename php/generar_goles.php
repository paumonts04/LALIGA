<?php
require_once 'conexion.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$res = $con->query("SELECT id FROM jugadores");
$jugadores = [];
if ($res) {
    while ($fila = $res->fetch_assoc()) {
        $jugadores[] = $fila;
    }
}
foreach ($jugadores as $jugador) {
    $id = $jugador['id'];
    $goles = rand(0, 50);
    $con->query("UPDATE jugadores SET goles = $goles WHERE id = $id");
}

header("Location: clasificacion.php");
exit();
?>
