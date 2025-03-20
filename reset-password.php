<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Проверка, существует ли пользователь с таким email
    $sql = "SELECT * FROM Users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Отправка кода на email (заглушка)
        echo json_encode(['success' => true, 'message' => 'Код отправлен на ваш email']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Пользователь с таким email не найден']);
    }
}
?>