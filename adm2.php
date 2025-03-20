<?php

session_start();

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

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}

// Запрос для получения списка пользователей
$sql = "SELECT user_id, username, email, phone, role_id FROM Users";
$stmt = $pdo->query($sql);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="adm2.css">
    <link href="https://fonts.googleapis.com/css2?family=Etude+Noire&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ панель - Пользователи</title>
</head>
<body>

<!-- Левая панель -->
<div class="sidebar">
    <h1>Админ панель</h1>
    <h3><a href="adm1.php">Заказы</a></h3>
    <h3><a href="adm2.php">Пользователи</a></h3>
    <h3><a href="adm3.php">Товары</a></h3>
    <button class="logout-button" onclick="window.location.href='logout.php'">Выход</button> <!-- Кнопка выхода -->
</div>

<!-- Список пользователей -->
<div class="content">
    <h2>Список пользователей</h2>
    <table>
        <tr>
            <th>ID пользователя</th>
            <th>Имя</th>
            <th>Почта</th>
            <th>Телефон</th>
            <th>Роль</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
    <td><?= htmlspecialchars($user['user_id'] ?? '') ?></td>
    <td><?= htmlspecialchars($user['username'] ?? '') ?></td>
    <td><?= htmlspecialchars($user['email'] ?? '') ?></td>
    <td><?= htmlspecialchars($user['phone'] ?? '') ?></td>
    <td>
        <?php
        // Преобразуем role_id в название роли
        switch ($user['role_id'] ?? 0) { // Добавлено ?? 0 для обработки NULL
            case 1:
                echo "Админ";
                break;
            case 2:
                echo "Пользователь";
                break;
            case 3:
                echo "Гость";
                break;
            default:
                echo "Неизвестно";
        }
        ?>
    </td>
</tr>
        <?php endforeach; ?>
    </table>
</div>

</body>
</html>