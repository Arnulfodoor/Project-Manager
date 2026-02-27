<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ProjectHub</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>

<div class="sidebar">
    <h2>🚀 ProjectHub</h2>
    <a href="/admin/main">Dashboard</a>
    <a href="/admin/crear">Nuevo Proyecto</a>
    <a href="../logout.php">Cerrar sesión</a>
</div>

<div class="main-content">