<?php
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

// Получаем поисковый запрос
$query = isset($_GET['query']) ? $_GET['query'] : '';

// Подготовка SQL-запроса
$sql = "SELECT * FROM Product 
        WHERE title LIKE ? OR category LIKE ? OR description LIKE ?";
$stmt = $conn->prepare($sql);

// Добавляем % для поиска по частичному совпадению
$searchQuery = "%$query%";
$stmt->bind_param("sss", $searchQuery, $searchQuery, $searchQuery);

// Выполняем запрос
$stmt->execute();
$result = $stmt->get_result();

$products = [];

// Формируем массив с результатами
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

// Возвращаем данные в формате JSON
header('Content-Type: application/json');
echo json_encode($products);

// Закрываем соединение
$stmt->close();
$conn->close();
?>