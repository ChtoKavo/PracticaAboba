<?php
include 'db.php';

// SQL-запрос для извлечения данных о товарах
$sql = "SELECT id, name, description, weight, price, old_price, imageUrl, discount FROM Products";
$result = mysqli_query($conn, $sql);

// Проверяем, есть ли результаты
if (mysqli_num_rows($result) > 0) {
    // Выводим данные для каждого товара
    while($row = mysqli_fetch_assoc($result)) {
        echo '<div class="product">';
        echo '    <div class="image-container">';
        echo '        <img src="' . htmlspecialchars($row["imageUrl"]) . '" alt="' . htmlspecialchars($row["name"]) . '" class="product-image">';
        
        // Проверяем, есть ли скидка
        if (!empty($row["discount"])) {
            echo '        <div class="discount-text">-' . htmlspecialchars($row["discount"]) . '%</div>';
        }
        
        echo '    </div>';
        echo '    <div class="product-info">';
        echo '        <div class="product-button-top-right">';
        echo '            <img src="Vector3.svg" alt="Кнопка 5" />';
        echo '        </div>';
        echo '        <div class="product-name">' . htmlspecialchars($row["name"]) . '</div>';
        echo '        <div class="product-somthing">' . htmlspecialchars($row["description"]) . '</div>';
        echo '        <div class="product-somthing">' . htmlspecialchars($row["weight"]) . '</div>';
        echo '        <div class="product-price-and-button">';
        echo '            <div class="product-price">' . htmlspecialchars($row["price"]) . ' ₽</div>';
        echo '            <div class="product-price2">' . htmlspecialchars($row["old_price"]) . ' ₽</div>';
        echo '            <button class="image-button-cart">';
        echo '                <img src="Vector1.png" alt="Кнопка 4" />';
        echo '            </button>';
        echo '        </div>';
        echo '    </div>';
        echo '</div>';
    }
} else {
    echo "Нет товаров в базе данных.";
}

// Закрываем соединение
mysqli_close($conn);
?>
