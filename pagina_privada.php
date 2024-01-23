<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Mostrar contenido privado
echo "Bienvenido, " . $_SESSION['usuario'];
?>
