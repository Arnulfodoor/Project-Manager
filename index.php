<?php
session_start();

if (isset($_SESSION["admin"])) {
    header("Location: admin/main");
} else {
    header("Location: login");
}
exit();
?>