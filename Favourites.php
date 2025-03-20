<?php
session_start();
include 'db.php'; // Подключение к базе данных
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Избранное</title>
    <link rel="stylesheet" href="Favourites.css">
    <style>
        a {
            text-decoration: none; /* Убирает подчеркивание */
            outline: none; /* Убирает обводку при фокусе */
            color: inherit; /* Наследует цвет текста */
        }

        a:focus, a:active {
            outline: none; /* Убирает обводку при фокусе и активном состоянии */
        }

        .content-container {
            max-width: 1200px; /* Ограничение максимальной ширины контейнера */
            margin: 0 auto; /* Центрирование контейнера */
            padding: 20px; /* Добавьте отступы для лучшего визуального восприятия */
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr); /* 4 колонки */
            gap: 20px; /* Расстояние между элементами */
        }

        .product {
            border: 1px solid #ccc; /* Граница для наглядности */
            padding: 10px;
            text-align: left; /* Выравнивание текста по левому краю */
        }

        .product-info {
            text-align: left; /* Выравнивание текста по левому краю */
        }

        .product-name, .product-somthing, .product-price-and-button {
            text-align: left; /* Выравнивание текста по левому краю */
        }

        .title {
            text-align: left; /* Выравнивание текста по левому краю */
            margin-left: 20px; /* Отступ слева */
        }

        @media (max-width: 1200px) {
            .products-grid {
                grid-template-columns: repeat(3, 1fr); /* 3 колонки на экранах меньше 1200px */
            }
        }

        @media (max-width: 768px) {
            .products-grid {
                grid-template-columns: repeat(2, 1fr); /* 2 колонки на экранах меньше 768px */
            }
        }

        @media (max-width: 480px) {
            .products-grid {
                grid-template-columns: 1fr; /* 1 колонка на экранах меньше 480px */
            }
        }
    </style>
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
        <button class="image-button">
            <a href="Cart.php"><img src="Vector1.png" alt="Корз"></a>
        </button>
        <?php
        $isLoggedIn = isset($_SESSION['user_id']);
        ?>
        <a href="login.php">
            <button class="image-button" id="profile-button">
                <img src="Vector2.png" alt="Польз">
            </button>
        </a>
    </div>

    <div class="content-container">
        <h3 class="title">Избранное</h3>
        <div class="products-grid">
            <?php
            // Получаем избранные товары из базы данных (если пользователь авторизован)
            if (isset($_SESSION['user_id'])) {
                $userId = $_SESSION['user_id'];
                $sql = "SELECT p.*, c.category_name 
                        FROM product p 
                        JOIN Category c ON p.category_id = c.category_id
                        JOIN favorites f ON p.product_id = f.product_id
                        WHERE f.user_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $userId);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="product">
                                <div class="image-container">
                                    <img src="' . $row['img'] . '" alt="Товар 1" class="product-image">
                                    <div class="discount-text">-50%</div>
                                </div>
                                <div class="product-info">
                                    <div class="product-button-top-right" onclick="removeFromFavorites(' . $row['product_id'] . ')">
                                        <img src="Vector3.svg" alt="Удалить из избранного" />
                                    </div>
                                    <div class="product-name">' . $row['title'] . '</div>
                                    <div class="product-somthing">' . $row['category_name'] . '</div>
                                    <div class="product-somthing">' . $row['weight'] . ' г</div>
                                    <div class="product-price-and-button">
                                        <div class="product-price">' . ($row['price'] / 100 * $row['discount']) . '₽</div>
                                        <div class="product-price2">' . $row['price'] . ' ₽</div>
                                        <button class="image-button-cart">
                                            <img src="Vector1.png" alt="Кнопка 4" />
                                        </button>
                                    </div>
                                </div>
                              </div>';
                    }
                } else {
                    echo '<p>В избранном пока нет товаров.</p>';
                }

                // Закрытие соединения
                $stmt->close();
            } else {
                echo '<p>Для просмотра избранного войдите в систему.</p>';
            }

            $conn->close();
            ?>
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
        // Функция для удаления товара из избранного
        function removeFromFavorites(productId) {
            fetch('remove_from_favorites.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ product_id: productId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Товар удален из избранного!');
                    location.reload(); // Перезагрузка страницы для обновления списка
                } else {
                    alert('Ошибка при удалении товара из избранного.');
                }
            })
            .catch(error => {
                console.error('Ошибка:', error);
            });
        }
    </script>
</body>
</html>