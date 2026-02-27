<?php
require_once "../includes/auth.php";
require_once "../config/database.php";
require_once "../includes/header.php";

$result = $conn->query("SELECT * FROM proyectos ORDER BY fecha_creacion DESC");
?>

<h1>Panel de Proyectos</h1>

<a href="crear_proyecto.php">+ Nuevo Proyecto</a>

<hr>

<?php while($row = $result->fetch_assoc()): ?>
    <div class="card">
        <h3><?= htmlspecialchars($row["nombre"]) ?></h3>
        <p><?= htmlspecialchars($row["descripcion"]) ?></p>
        <br>
        <a class="btn btn-secondary" href="ver_proyecto.php?id=<?= $row["id"] ?>">Ver</a>
        <a class="btn btn-primary" href="editar_proyecto.php?id=<?= $row["id"] ?>">Editar</a>
        <a class="btn btn-danger" href="eliminar_proyecto.php?id=<?= $row["id"] ?>" onclick="return confirm('¿Seguro?')">Eliminar</a>
    </div>
<?php endwhile; ?>

<?php require_once "../includes/footer.php"; ?>