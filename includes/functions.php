<?php

function limpiar($dato) {
    return htmlspecialchars(trim($dato), ENT_QUOTES, 'UTF-8');
}

function redireccionar($ruta) {
    header("Location: $ruta");
    exit();
}

function mensaje($texto, $tipo = "success") {
    return "<div class='alert $tipo'>$texto</div>";
}
?>