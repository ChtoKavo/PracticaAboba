<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['user_id'])) {
        $product_id = $_POST['product_id'];
        $rating = $_POST['rating'];
        $review_text = $_POST['review_text'];
        $user_id = $_SESSION['user_id'];

        $sql = "INSERT INTO Reviews (product_id, user_id, rating, review_text) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("iiis", $product_id, $user_id, $rating, $review_text);
            if ($stmt->execute()) {
                header("Location: Product Page.php?id=" . $product_id);
                exit();
            } else {
                echo "Ошибка при добавлении отзыва: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Ошибка подготовки запроса: " . $conn->error;
        }
    } else {
        echo "Пожалуйста, войдите в систему, чтобы оставить отзыв.";
    }
} else {
    echo "Неверный метод запроса.";
}

$conn->close();
?>