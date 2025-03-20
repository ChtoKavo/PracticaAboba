<?php
session_start();

// Проверяем, авторизован ли пользователь
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Пользователь не авторизован']);
    exit;
}

// Получаем данные из запроса
$data = json_decode(file_get_contents('php://input'), true);
$product_id = $data['product_id'];

// Подключаемся к базе данных
include 'db.php';

// Проверяем, есть ли товар уже в корзине
$stmt = $conn->prepare("SELECT * FROM Cart WHERE user_id = ? AND product_id = ?");
$stmt->bind_param("ii", $_SESSION['user_id'], $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Если товар уже в корзине, увеличиваем количество
    $stmt = $conn->prepare("UPDATE Cart SET quantity = quantity + 1 WHERE user_id = ? AND product_id = ?");
    $stmt->bind_param("ii", $_SESSION['user_id'], $product_id);
} else {
    // Если товара нет в корзине, добавляем его
    $stmt = $conn->prepare("INSERT INTO Cart (user_id, product_id, quantity) VALUES (?, ?, 1)");
    $stmt->bind_param("ii", $_SESSION['user_id'], $product_id);
}

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Ошибка при добавлении товара в корзину']);
}

$stmt->close();
$conn->close();
?>