<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function generarToken() {
    if (empty($_SESSION['token'])) {
        $_SESSION['token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['token'];
}

function verificarToken($token) {
    if (!isset($_SESSION['token']) || $token !== $_SESSION['token']) {
        die("Token CSRF inválido.");
    }
}
?>