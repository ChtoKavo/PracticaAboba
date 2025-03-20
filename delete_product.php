<?php
include 'db.php'; // Подключение к базе данных

// Получаем данные из POST-запроса
$data = json_decode(file_get_contents("php://input"), true);
$productId = $data['id'] ?? null;

if ($productId) {
    // Подготовка SQL-запроса для удаления книги
    $stmt = $conn->prepare("DELETE FROM Product WHERE product_id = ?");
    $stmt->bind_param("i", $productId);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Товар успешно удален!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Ошибка: ' . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'ID товар не передан.']);
}

$conn->close();
?>
<script>
    function deleteBook(productId) {
    if (confirm('Вы уверены, что хотите удалить этот товар?')) {
        fetch('delete_product.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ id: product_id }),
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.success) {
                location.reload(); // Обновляем страницу
            }
        });
    }
}

</script>