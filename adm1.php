<?php

session_start();

$servername = 'localhost';
$dbname = 'PR2'; 
$username = 'root'; 
$password = 'Und_ofg'; 

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}

// Проверка роли пользователя
// if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 1) {
//     die("Доступ запрещен. Вы не администратор.");
// }

// Запрос для получения списка заказов
$sql = "SELECT order_id, user_id, customer_name, delivery_address, total_price, order_name, status FROM Orders";
$stmt = $pdo->query($sql);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="adm1.css">
    <link href="https://fonts.googleapis.com/css2?family=Etude+Noire&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ панель - Заказы</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>

<!-- Левая панель -->
<div class="sidebar">
    <h1>Админ панель</h1>
    <h3><a href="adm1.php">Заказы</a></h3>
    <h3><a href="adm2.php">Пользователи</a></h3>
    <h3><a href="adm3.php">Товары</a></h3>
    <button class="logout-button" onclick="window.location.href='logout.php'">Выход</button>
</div>

<!-- Список заказов -->
<div class="content">
    <h2>Список заказов</h2>
    <?php if (empty($orders)): ?>
        <p>Заказов нет.</p>
    <?php else: ?>
        <table>
            <tr>
                <th>ID заказа</th>
                <th>ID клиента</th>
                <th>Имя клиента</th>
                <th>Адрес доставки</th>
                <th>Стоимость</th>
                <th>Название заказа</th>
                <th>Статус</th>
            </tr>
            <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= htmlspecialchars($order['order_id']) ?></td>
                <td><?= htmlspecialchars($order['user_id']) ?></td>
                <td><?= htmlspecialchars($order['customer_name']) ?></td>
                <td><?= htmlspecialchars($order['delivery_address']) ?></td>
                <td><?= htmlspecialchars($order['total_price']) ?></td>
                <td><?= htmlspecialchars($order['order_name']) ?></td>
                <td><?= htmlspecialchars($order['status']) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>

</body>
</html>