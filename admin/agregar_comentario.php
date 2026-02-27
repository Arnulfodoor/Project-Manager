<?php
require_once "../includes/auth.php";
require_once "../config/database.php";
require_once "../includes/functions.php";
require_once "../includes/csrf.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    verificarToken($_POST['token']);

    $proyecto_id = intval($_POST["proyecto_id"]);
    $comentario = limpiar($_POST["comentario"]);

    $stmt = $conn->prepare("INSERT INTO comentarios (proyecto_id, comentario) VALUES (?, ?)");
    $stmt->bind_param("is", $proyecto_id, $comentario);
    $stmt->execute();

    header("Location: ver_proyecto.php?id=" . $proyecto_id);
    exit();
}
?>