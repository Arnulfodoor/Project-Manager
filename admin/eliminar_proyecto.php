<?php
require_once "../includes/auth.php";
require_once "../config/database.php";

$id = intval($_GET["id"]);

$stmt = $conn->prepare("DELETE FROM proyectos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: dashboard.php");
exit();
?>