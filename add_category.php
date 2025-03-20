<?php
include 'db.php'; // Подключаемся к базе данных

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $categoryName = $_POST['categoryName'];
}