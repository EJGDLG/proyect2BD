<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['password'])) {
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        if (!empty($nombre)) {
            $stmt = $conn->prepare("INSERT INTO usuarios (nombre, correo, password) VALUES (:nombre, :correo, :password)");
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':password', $password);

            if ($stmt->execute()) {
                echo "Usuario registrado correctamente.";

                header("Location: login.php");
                exit(); 
            } else {
                echo "Error al registrar el usuario.";
            }
        } else {
            echo "El nombre no puede estar vacío.";
        }
    } else {
        echo "Todos los campos son requeridos.";
    }
}
?>

<form method="post" action="signup.php">
    Nombre: <input type="text" name="nombre" required><br>
    Correo: <input type="email" name="correo" required><br>
    Contraseña: <input type="password" name="password" required><br>
    <input type="submit" value="Registrarse">
</form>
<form method="post" action="login.php">
    <input type="submit" value=" sign in">
</form>