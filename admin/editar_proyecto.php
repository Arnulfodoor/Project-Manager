<?php
require_once "../includes/auth.php";
require_once "../config/database.php";
require_once "../includes/functions.php";
require_once "../includes/csrf.php";
require_once "../includes/header.php";

$id = intval($_GET["id"]);

$stmt = $conn->prepare("SELECT * FROM proyectos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$proyecto = $stmt->get_result()->fetch_assoc();

if (!$proyecto) {
    die("Proyecto no encontrado");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    verificarToken($_POST['token']);

    $nombre = limpiar($_POST["nombre"]);
    $descripcion = limpiar($_POST["descripcion"]);
    $enlace = limpiar($_POST["enlace"]);
    $documentacion = limpiar($_POST["documentacion"]);

    $stmt = $conn->prepare("UPDATE proyectos SET nombre=?, descripcion=?, enlace=?, documentacion=? WHERE id=?");
    $stmt->bind_param("ssssi", $nombre, $descripcion, $enlace, $documentacion, $id);
    $stmt->execute();

    redireccionar("dashboard.php");
}
?>

<h1>Editar Proyecto</h1>

<form method="POST">
    <input type="hidden" name="token" value="<?= generarToken(); ?>">

    <input type="text" name="nombre" value="<?= htmlspecialchars($proyecto["nombre"]) ?>" required><br><br>

    <textarea name="descripcion"><?= htmlspecialchars($proyecto["descripcion"]) ?></textarea><br><br>

    <input type="url" name="enlace" value="<?= htmlspecialchars($proyecto["enlace"]) ?>"><br><br>

    <textarea name="documentacion"><?= htmlspecialchars($proyecto["documentacion"]) ?></textarea><br><br>

    <button type="submit">Actualizar</button>
</form>

<?php require_once "../includes/footer.php"; ?>