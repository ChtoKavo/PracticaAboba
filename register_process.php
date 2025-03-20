<?php
session_start();

$host = 'localhost';
$dbname = 'PR2';
$username = 'root';
$password = 'Und_ofg';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}

// Получение данных из формы
$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm-password'] ?? '';

// Проверка совпадения паролей
if ($password !== $confirm_password) {
    die("Пароли не совпадают.");
}


// Проверка, существует ли пользователь с таким email
$stmt = $conn->prepare("SELECT * FROM Users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    die("Пользователь с таким email уже существует.");
}

// Добавление нового пользователя в базу данных
$stmt = $conn->prepare("INSERT INTO Users (username, email, pass, role_id) VALUES (?, ?, ?, ?)");
$stmt->execute([$username, $email, $password, 2]);

if ($stmt->rowCount() > 0) {
    // Успешная регистрация
    header("Location: login.php");
    exit();
} else {
    die("Ошибка при регистрации.");
}
?>