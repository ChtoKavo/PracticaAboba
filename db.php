<?php
$servername = 'localhost';
$dbname = 'PR2'; 
$username = 'root'; 
$password = 'Und_ofg'; 

// Создаем соединение с базой данных
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем соединение
if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}

// Закрытие подключения


?>
