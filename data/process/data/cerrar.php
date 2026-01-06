<?php
session_start();
session_unset();
session_destroy();

// Redirigir al usuario a la página de inicio
header("Location: ../panel/index.php");
exit();
?>
