<?php
include '../login/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['meseroid']) && isset($_POST['comidas']) && isset($_POST['bebidas'])) {
        $meseroid = $_POST['meseroid'];
        $comidas = $_POST['comidas'];
        $bebidas = $_POST['bebidas'];

        // Crear una nueva orden
        $stmt = $conn->prepare("INSERT INTO ordenes (meseroid, estado) VALUES (:meseroid, 'pendiente')");
        $stmt->bindParam(':meseroid', $meseroid);
        $stmt->execute();
        $ordenid = $conn->lastInsertId();

        // Agregar comidas a la orden
        foreach ($comidas as $comida) {
            $stmt = $conn->prepare("INSERT INTO ordenes (ordenid, comidaid, unidad) VALUES (:ordenid, :comidaid, 1)");
            $stmt->bindParam(':ordenid', $ordenid);
            $stmt->bindParam(':comidaid', $comida);
            $stmt->execute();
        }

        // Agregar bebidas a la orden
        foreach ($bebidas as $bebida) {
            $stmt = $conn->prepare("INSERT INTO ordenes (ordenid, bebidaid, unidad) VALUES (:ordenid, :bebidaid, 1)");
            $stmt->bindParam(':ordenid', $ordenid);
            $stmt->bindParam(':bebidaid', $bebida);
            $stmt->execute();
        }

        // Redireccionar al archivo de reportes
        header("Location: generar_reportes.php");
        exit();
    } else {
        echo "Por favor, complete todos los campos del formulario.";
    }
}
?>

<form method="post" action="pedido.php">
    Mesero ID: <input type="text" name="meseroid" required><br>

    <h3>Comidas</h3>
    <input type="checkbox" name="comidas[]" value="1"> Comida 1<br>
    <input type="checkbox" name="comidas[]" value="2"> Comida 2<br>
    <!-- Agregar más comidas según sea necesario -->

    <h3>Bebidas</h3>
    <input type="checkbox" name="bebidas[]" value="1"> Bebida 1<br>
    <input type="checkbox" name="bebidas[]" value="2"> Bebida 2<br>
    <!-- Agregar más bebidas según sea necesario -->

    <input type="submit" value="Tomar Pedido">
</form>
<form method="post" action="cocina.php">
    <input type="submit" value="Regresar a Cocina">
</form>
<form method="post" action="../login/login.php">
    <input type="submit" value="Cerrar sesion">
</form>