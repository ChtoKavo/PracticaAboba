<?php
session_start();
session_destroy(); // Уничтожение сессии
header("Location: index.php"); // Перенаправление на главную страницу
exit();
?>