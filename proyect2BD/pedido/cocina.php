<?php
include '../login/config.php';

$stmt = $conn->prepare("SELECT * FROM ordenes WHERE comidaid IS NOT NULL AND estado = 'P' ORDER BY ordenid ASC");
$stmt->execute();
$platos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pantalla de Cocina</title>
</head>
<body>

<h1 align="center">Listado de Platos a Preparar</h1>
<table border="1" align="center">
    <thead>
        <tr>
            <th>Orden ID</th>
            <th>Mesero ID</th>
            <th>Comida ID</th>
            <th>Unidad</th>
            <th>Estado</th>
            <th>Total Orden</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($platos as $plato): ?>
            <tr>
                <td><?php echo $plato['ordenid']; ?></td>
                <td><?php echo $plato['meseroid']; ?></td>
                <td><?php echo $plato['comidaid']; ?></td>
                <td><?php echo $plato['unidad']; ?></td>
                <td><?php echo $plato['estado']; ?></td>
                <td><?php echo $plato['totalorden']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<br>
<br>
<hr>
<br>
<br>
<table border="1" align="center">
    <tr>
        <td>comida 1</td>
        <td>comida 2</td>
        <td>comida 3</td>
        <td>comida 4</td>
        <td>comida 5</td>
        <td>comida 6</td>
    </tr>
</table>

<form method="post" action="bar.php">
    <input type="submit" value="Ir al bar">
</form>
<form method="post" action="../login/login.php">
    <input type="submit" value="Cerrar sesion">
</form>

</body>
</html>
