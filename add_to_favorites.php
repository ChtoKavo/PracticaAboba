<?php
session_start();
include 'db.php'; // Подключение к базе данных

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $productId = $data['product_id'];

    // Проверка, авторизован ли пользователь
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];

        // Проверка, есть ли уже товар в избранном у пользователя
        $sql = "SELECT * FROM favorites WHERE user_id = ? AND product_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $userId, $productId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            // Добавление товара в избранное
            $sql = "INSERT INTO favorites (user_id, product_id) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $userId, $productId);
            $stmt->execute();

            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Товар уже в избранном.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Пользователь не авторизован.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Некорректный метод запроса.']);
}
?>