<?php
include '../login/config.php';

// Función para el Reporte 1
function reportePlatosMasPedidos($fechaInicio, $fechaFin) {
    global $conn;
    $stmt = $conn->prepare("
        SELECT plato_id, COUNT(plato_id) as cantidad
        FROM pedido
        WHERE fecha BETWEEN :fechaInicio AND :fechaFin
        GROUP BY plato_id
        ORDER BY cantidad DESC
        LIMIT 10
    ");
    $stmt->bindParam(':fechaInicio', $fechaInicio);
    $stmt->bindParam(':fechaFin', $fechaFin);
    $stmt->execute();
    return $stmt->fetchAll();
}

// Función para el Reporte 2
function reporteHorarioMasPedidos($fechaInicio, $fechaFin) {
    global $conn;
    $stmt = $conn->prepare("
        SELECT HOUR(fecha) as hora, COUNT(id) as cantidad
        FROM pedido
        WHERE fecha BETWEEN :fechaInicio AND :fechaFin
        GROUP BY HOUR(fecha)
        ORDER BY cantidad DESC
        LIMIT 1
    ");
    $stmt->bindParam(':fechaInicio', $fechaInicio);
    $stmt->bindParam(':fechaFin', $fechaFin);
    $stmt->execute();
    return $stmt->fetch();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Generar Reportes
    if (isset($_POST['reporte'])) {
        $fechaInicio = $_POST['fecha_inicio'];
        $fechaFin = $_POST['fecha_fin'];

        switch ($_POST['reporte']) {
            case 'platos_mas_pedidos':
                $reporte = reportePlatosMasPedidos($fechaInicio, $fechaFin);
                $titulo = "Reporte de Platos Más Pedidos";
                $columnas = ["Plato ID", "Cantidad"];
                break;
            case 'horario_mas_pedidos':
                $reporte = reporteHorarioMasPedidos($fechaInicio, $fechaFin);
                $titulo = "Reporte de Horario con Más Pedidos";
                $contenido = "La hora con más pedidos es: " . $reporte['hora'] . " horas con " . $reporte['cantidad'] . " pedidos.";
                break;
            // Agregar más casos para los otros reportes...
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Generar Reporte</title>
</head>
<body>

<!-- Formulario para Generar Reportes -->
<form method="post" action="pedido.php">
    Fecha de Inicio: <input type="date" name="fecha_inicio" required><br>
    Fecha de Fin: <input type="date" name="fecha_fin" required><br>
    <select name="reporte">
        <option value="platos_mas_pedidos">Reporte de Platos Más Pedidos</option>
        <option value="horario_mas_pedidos">Reporte de Horario con Más Pedidos</option>
        <!-- Agregar más opciones para los otros reportes... -->
    </select>
    <input type="submit" value="Generar Reporte">
</form>

<!-- Mostrar el informe -->
<?php
if (isset($reporte)) {
    echo "<h2>$titulo</h2>";
    if (isset($columnas)) {
        echo "<table border='1'>
                <tr>";
        foreach ($columnas as $columna) {
            echo "<th>$columna</th>";
        }
        echo "</tr>";
        foreach ($reporte as $fila) {
            echo "<tr>
                    <td>" . $fila['plato_id'] . "</td>
                    <td>" . $fila['cantidad'] . "</td>
                  </tr>";
        }
        echo "</table>";
    } elseif (isset($contenido)) {
        echo "<p>$contenido</p>";
    }
}
?>

</body>
</html>
