<?php
require_once 'conexion.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'header.php';

$sql = "SELECT 
            e.id_equipo,
            e.equipo,
            SUM(j.goles) AS goles_totales
        FROM equipos e
        JOIN jugadores j ON e.id_equipo = j.id_equipo
        GROUP BY e.id_equipo, e.equipo
        ORDER BY goles_totales DESC, e.equipo ASC
        LIMIT 10";

$res = $con->query($sql);
?>

<main class="content-wrapper">
    <div class="titulo-pagina">
        <h1>Clasificacion de Equipos</h1>
        <p>Ordenados de mayor a menor por goles totales.</p>
    </div>

    <div class="tabla-clasificacion-wrapper">
        <table class="tabla-clasificacion">
            <thead>
                <tr>
                    <th>Posicion</th>
                    <th>Equipo</th>
                    <th>Goles Totales</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($res && $res->num_rows > 0) {
                    $posicion = 1;
                    while ($fila = $res->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $posicion; ?></td>
                            <td><?php echo htmlspecialchars($fila['equipo']); ?></td>
                            <td><?php echo (int)$fila['goles_totales']; ?></td>
                        </tr>
                        <?php
                        $posicion++;
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="3">No hay datos de clasificacion.</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</main>

<?php require_once 'footer.php'; ?>
