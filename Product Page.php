<?php
session_start();
include 'db.php'; 

$product_id = $_GET['id'] ?? null;

if ($product_id) {
    $sql = "SELECT * FROM product WHERE product_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Страница товара</title>
                    <link rel="stylesheet" href="Product Page.css">
                </head>
                <body>
                    <div class="attic">
                        <div class="logo">
                            <a href="Main.php">
                                <img src="A&A.svg" alt="Логотип">
                            </a>
                        </div>
                        <input type="text" class="search-input" placeholder="Название товара/категория...">
                        <button class="button catalog">Каталог</button>
                        <button class="image-button">
                            <a href="Favourites.php"><img src="Vector.png" alt="Избр"></a>
                        </button>
                        <a href="Cart.php">
                            <button class="image-button">
                                <img src="Vector1.png" alt="Корз">
                            </button>
                        </a>
                        <a href="login.php">
                            <button class="image-button" id="profile-button">
                                <img src="Vector2.png" alt="Польз">
                            </button>
                        </a>
                    </div>

                    <div class="product-page">
                        <div class="product-main-content">
                            <div class="product-image-container">
                                <img src="' . $row['img'] . '" alt="Product Image" class="product-image" id="main-image"> 
                                <div class="thumbnail-container">
                                    <img src="' . $row['img'] . '">
                                    <img src="' . $row['img'] . '">
                                    <img src="' . $row['img'] . '">
                                </div>
                            </div>
                            <div class="product-details">
                                <div class="product-name">' . $row['title'] . '</div>
                                <div class="product-price">' . ($row['price'] / 100 * $row['discount']) . '₽</div>
                                <div class="product-rating">
                                    ★★★★☆ <span class="rating-count">(123 отзыва)</span>
                                </div>
                                <div class="product-specifications">
                                    <div class="spec-item">
                                        <span class="spec-label">Состав:</span>
                                        <span class="spec-value">' . $row['composition'] . '</span>
                                    </div>
                                    <div class="spec-item">
                                        <span class="spec-label">Вес:</span>
                                        <span class="spec-value">' . $row['weight'] . ' г</span>
                                    </div>
                                    <div class="spec-item">
                                        <span class="spec-label">Срок годности:</span>
                                        <span class="spec-value">' . $row['expiration_date'] . '</span>
                                    </div>
                                </div>
                                <div class="product-actions">
                                    <button class="add-to-cart" onclick="addToCart(' . $row['product_id'] . ')">В корзину</button>
                                </div>
                            </div>
                        </div>
                        <div class="product-description-container">
                            <h2 class="description-title">Описание товара</h2>
                            <p class="product-description">
                                <span class="spec-value">' . $row['description'] . '</span>
                            </p>
                        </div>
                        <div class="product-reviews">
                            <h2 class="reviews-title">Отзывы</h2>
                            <div id="reviews-list">';

                // Вывод существующих отзывов
                $reviews_sql = "SELECT Reviews.*, Users.username FROM Reviews JOIN Users ON Reviews.user_id = Users.user_id WHERE product_id = ? ORDER BY created_at DESC";
                $reviews_stmt = $conn->prepare($reviews_sql);
                $reviews_stmt->bind_param("i", $product_id);
                $reviews_stmt->execute();
                $reviews_result = $reviews_stmt->get_result();

                if ($reviews_result->num_rows > 0) {
                    while ($review = $reviews_result->fetch_assoc()) {
                        echo '
                        <div class="review">
                            <div class="review-header">
                                <span class="review-author">' . htmlspecialchars($review['username']) . '</span>
                                <span class="review-rating">' . str_repeat('★', $review['rating']) . str_repeat('☆', 5 - $review['rating']) . '</span>
                            </div>
                            <p class="review-text">
                                ' . htmlspecialchars($review['review_text']) . '
                            </p>
                            <span class="review-date">' . $review['created_at'] . '</span>
                        </div>';
                    }
                } else {
                    echo '<p>Пока нет отзывов.</p>';
                }

                echo '
                            </div>';

                // Форма для добавления отзыва
                if (isset($_SESSION['user_id'])) {
                    echo '
                            <form id="review-form" method="POST" action="submit_review.php">
    <input type="hidden" name="product_id" value="' . $product_id . '">
    <div class="form-group">
        <label for="rating">Оценка:</label>
        <select id="rating" name="rating" required>
            <option value="5">★★★★★</option>
            <option value="4">★★★★☆</option>
            <option value="3">★★★☆☆</option>
            <option value="2">★★☆☆☆</option>
            <option value="1">★☆☆☆☆</option>
        </select>
    </div>
    <div class="form-group">
        <label for="review_text">Ваш отзыв:</label>
        <textarea id="review_text" name="review_text" required></textarea>
    </div>
    <button type="submit">Отправить отзыв</button>
</form>';
                } else {
                    echo '<p>Чтобы оставить отзыв, <a href="login.php">войдите</a> в аккаунт.</p>';
                }

                echo '
                        </div>
                    </div>

                    <div class="Basement">
                        <div class="logo">
                            <img src="A&A2.svg" alt="Логотип" class="image-button">
                        </div>
                        <div class="social-media-container">
                            <div class="social-media">
                                <img src="vk.svg" alt="VK" class="image-button2">
                            </div>
                            <div class="social-media">
                                <img src="odnoklassniki.svg" alt="Odnoklassniki" class="image-button2">
                            </div>
                            <div class="social-media">
                                <img src="tg.svg" alt="Telegram" class="image-button2">
                            </div>
                            <div class="social-media">
                                <img src="youtube.svg" alt="YouTube" class="image-button2">
                            </div>
                        </div>
                        <div class="footer-text">
                            <p>© A&A 2025. Все права защищены. Применяются рекомендательные технологии</p>
                        </div>
                        <div class="footer-text2">
                            <div class="column">
                                <h4>Страницы</h4>
                                <a href="Main.php">Главная</a>
                                <a href="Catalog.php">Каталог</a>
                                <a href="Cart.php">Корзина</a>
                                <a href="Favourites.php">Избранное</a>
                                <a href="Personal account.php">Профиль</a>
                                <a href="Delivery.php">Доставка</a>
                                <a href="Purchases.php">Покупки</a>
                            </div>
                            <div class="column">
                                <h4>Услуги</h4>
                                <a href="Delivery.php">Доставка</a>
                                <a href="support">Служба поддержки</a>
                            </div>
                            <div class="column">
                                <h4>Документация</h4>
                                <a href="expiration">Сроки годности</a>
                                <a href="storage-terms">Условия хранения</a>
                                <a href="composition">Состав</a>
                                <a href="Privacy Policy.php">Конфиденциальность</a>
                                <a href="Rules.php">Технологии</a>
                            </div>
                        </div>
                    </div>

                    <script>
                        function addToCart(productId) {
                            fetch("add_to_cart.php", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                },
                                body: JSON.stringify({ product_id: productId }),
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert("Товар добавлен в корзину!");
                                    window.location.href = "Cart.php"; // Перенаправление на страницу корзины
                                } else {
                                    alert("Ошибка: " + data.message);
                                }
                            })
                            .catch(error => {
                                console.error("Ошибка:", error);
                            });
                        }

                        document.getElementById("review-form").addEventListener("submit", function(event) {
                            event.preventDefault();

                            const formData = new FormData(this);

                            fetch("submit_review.php", {
                                method: "POST",
                                body: formData
                            })
                            .then(response => response.text())
                            .then(data => {
                                if (data.includes("Location")) {
                                    window.location.href = data.split("Location: ")[1].trim();
                                } else {
                                    alert("Ошибка при отправке отзыва: " + data);
                                }
                            })
                            .catch(error => {
                                console.error("Ошибка:", error);
                            });
                        });
                    </script>
                </body>
                </html>';
            }
        } else {
            echo "<p>Товар не найден.</p>";
        }

        $stmt->close();
    } else {
        echo "<p>Ошибка подготовки запроса.</p>";
    }
} else {
    echo "<p>Не указан ID товара.</p>";
}

$conn->close();
?>