<?php
require_once "../includes/auth.php";
require_once "../config/database.php";
require_once "../includes/functions.php";
require_once "../includes/csrf.php";
require_once "../includes/header.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    verificarToken($_POST['token']);

    $nombre = limpiar($_POST["nombre"]);
    $descripcion = limpiar($_POST["descripcion"]);
    $enlace = limpiar($_POST["enlace"]);
    $documentacion = limpiar($_POST["documentacion"]);

    $stmt = $conn->prepare("INSERT INTO proyectos (nombre, descripcion, enlace, documentacion) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nombre, $descripcion, $enlace, $documentacion);
    $stmt->execute();

    redireccionar("dashboard.php");
}
?>

<h1>Crear Proyecto</h1>

<form method="POST">
    <input type="hidden" name="token" value="<?= generarToken(); ?>">

    <input type="text" name="nombre" placeholder="Nombre" required><br><br>

    <textarea name="descripcion" placeholder="Descripción"></textarea><br><br>

    <input type="url" name="enlace" placeholder="Enlace"><br><br>

    <textarea name="documentacion" placeholder="Documentación"></textarea><br><br>

    <button type="submit">Crear</button>
</form>

<?php require_once "../includes/footer.php"; ?>