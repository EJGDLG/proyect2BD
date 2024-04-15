<?php
include '../login/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Aquí puedes agregar la lógica para procesar los datos del formulario si es necesario
}

$stmt = $conn->prepare("SELECT * FROM ordenes WHERE (comidaid IS NOT NULL OR bebidaid IS NOT NULL) AND estado = 'P' ORDER BY ordenid ASC");
$stmt->execute();
$bebidas = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Pantalla de Bar</title>
</head>
<body>

<h1 align="center">Listado de Bebidas a Preparar</h1>
<table border="1" align="center">
    <thead>
        <tr>
            <th>Orden ID</th>
            <th>Mesero ID</th>
            <th>Bebida ID</th>
            <th>Unidad</th>
            <th>Estado</th>
            <th>Total Orden</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($bebidas as $bebida): ?>
            <tr>
                <td><?php echo $bebida['ordenid']; ?></td>
                <td><?php echo $bebida['meseroid']; ?></td>
                <td><?php echo $bebida['bebidaid']; ?></td>
                <td><?php echo $bebida['unidad']; ?></td>
                <td><?php echo $bebida['estado']; ?></td>
                <td><?php echo $bebida['totalorden']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<br>
<br>
<hr>
<br>
<br>
<!-- Aquí puedes agregar el código para mostrar las comidas pendientes si lo necesitas -->
<table border="1" align="center">
    <!-- Ejemplo de datos de comidas pendientes -->
    <tr>
        <td>Bebida B1</td>
        <td>Bebida B2</td>
        <td>Bebida B3</td>
        <td>Bebida B4</td>
        <td>Bebida B5</td>
        <td>Bebida B6</td>
        <td>Bebida B7</td>
        <td>Bebida B8</td>
        <td>Bebida B9</td>
        <td>Bebida B10</td>
    </tr>
</table>
<br>
<br>
<form method="post" action="cocina.php">
    <input type="submit" value="Regresar a Cocina">
</form>

<form method="post" action="pedido.php">
    <input type="submit" value="Realizar un pedido">
</form>

<form method="post" action="../login/login.php">
    <input type="submit" value="cerrar sesion">
</form>

</body>
</html>
