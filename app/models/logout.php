<?php
session_start(); // Iniciar sesión

// Eliminar todas las variables de sesión
session_unset();

// Destruir la sesión
session_destroy();

// Redirigir a la página de inicio
header("Location: ../../public/index.php"); // Cambia "index.php" por tu página de inicio
exit();
?>
