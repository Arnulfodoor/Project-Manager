<?php
session_start();
require_once "config/database.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $usuario = trim($_POST["usuario"]);
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {

        $user = $resultado->fetch_assoc();

        if (password_verify($password, $user["password"])) {
            $_SESSION["admin"] = $user["id"];
            header("Location: admin/main");
            exit();
        } else {
            $error = "Contraseña incorrecta";
        }

    } else {
        $error = "Usuario no encontrado";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Panel</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="center-screen">

<div class="login-container">
    <h2 style="margin-bottom:20px;">🚀 ProjectHub</h2>

    <?php if($error): ?>
        <div class="alert error"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="usuario" placeholder="Usuario" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button class="btn btn-primary" type="submit">Entrar</button>
    </form>
</div>

</body>
</html>