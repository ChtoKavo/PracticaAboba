<?php
header('Content-Type: application/json'); // Указываем, что возвращаем JSON

// Подключение к базе данных
$servername = 'localhost';
$db = 'pract2'; 
$username = 'root'; 
$password = '235PoolJob'; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// SQL-запрос для получения товаров
$sql = "SELECT p.product_id, p.title, p.description, p.weight, p.price, p.discount, p.discounted_price, c.category_name 
        FROM Product p
        JOIN Category c ON p.category_id = c.category_id";
$result = $conn->query($sql);

$products = [];

// Формируем массив с товарами
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

// Возвращаем данные в формате JSON
echo json_encode($products);

// Закрываем соединение
$conn->close();
?>

