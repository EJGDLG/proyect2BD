<?php
include 'config.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['correo']) && isset($_POST['password'])) {
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM usuarios WHERE correo = :correo");
    $stmt->bindParam(':correo', $correo);
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Inicio de sesión exitoso, redirigir a la pantalla de cocina
        header("Location: ../pedido/cocina.php");
        exit();
    } else {
        echo "Correo o contraseña incorrectos.";
    }
}
?>

<form method="post" action="login.php">
    Correo: <input type="email" name="correo" required><br>
    Contraseña: <input type="password" name="password" required><br>
    <input type="submit" value="Iniciar sesión">
</form>
<form method="post" action="signup.php">
    <input type="submit" value=" sign up">
</form>
