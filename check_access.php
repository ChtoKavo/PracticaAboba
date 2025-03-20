<?php
session_start();

// Если пользователь не авторизован, присваиваем роль "Гость"
if (!isset($_SESSION['role_id'])) {
    $_SESSION['role_id'] = 3; // Роль "Гость"
}

// Функция для проверки доступа
function checkAccess($requiredRole) {
    if ($_SESSION['role_id'] < $requiredRole) {
        die("Доступ запрещен.");
    }
}
?>