<?php
require_once "../includes/auth.php";
require_once "../config/database.php";
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

$comentarios = $conn->prepare("SELECT * FROM comentarios WHERE proyecto_id = ? ORDER BY fecha DESC");
$comentarios->bind_param("i", $id);
$comentarios->execute();
$resultComentarios = $comentarios->get_result();
?>

<h1><?= htmlspecialchars($proyecto["nombre"]) ?></h1>

<p><?= nl2br(htmlspecialchars($proyecto["descripcion"])) ?></p>

<p><a href="<?= htmlspecialchars($proyecto["enlace"]) ?>" target="_blank">Ir al proyecto</a></p>

<h3>Documentación</h3>
<p><?= nl2br(htmlspecialchars($proyecto["documentacion"])) ?></p>

<hr>

<h3>Comentarios</h3>

<form action="agregar_comentario.php" method="POST">
    <input type="hidden" name="token" value="<?= generarToken(); ?>">
    <input type="hidden" name="proyecto_id" value="<?= $id ?>">
    <textarea name="comentario" required></textarea><br>
    <button type="submit">Agregar comentario</button>
</form>

<hr>

<?php while($coment = $resultComentarios->fetch_assoc()): ?>
    <div>
        <p><?= nl2br(htmlspecialchars($coment["comentario"])) ?></p>
        <small><?= $coment["fecha"] ?></small>
        <a href="eliminar_comentario.php?id=<?= $coment["id"] ?>&proyecto=<?= $id ?>">Eliminar</a>
    </div>
    <hr>
<?php endwhile; ?>

<?php require_once "../includes/footer.php"; ?>