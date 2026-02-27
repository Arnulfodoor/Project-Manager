<?php
require_once "../includes/auth.php";
require_once "../config/database.php";

$id = intval($_GET["id"]);
$proyecto = intval($_GET["proyecto"]);

$stmt = $conn->prepare("DELETE FROM comentarios WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: ver_proyecto.php?id=" . $proyecto);
exit();
?>