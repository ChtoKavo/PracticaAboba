<?php
session_start();
include 'db.php';

// Проверка доступа
require 'check_access.php';
checkAccess(2); // Только для пользователей (role_id >= 2)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет</title>
    <link rel="stylesheet" href="Personal account.css">
</head>
<body>
<div class="attic">
        <div class="logo">
            <img src="A&A.svg" alt="Логотип">
        </div>
        <input type="text" class="search-input" id="searchInput" placeholder="Название товара/категория...">
        <a href="Catalog.php" class="button catalog">Каталог</a>
        <button class="image-button">
            <a href="Favourites.php"><img src="Vector.png" alt="Избр"></a>
        </button>
        <a href="Cart.php">
            <button class="image-button">
                <img src="Vector1.png" alt="Корз">
            </button>
        </a>
        <?php
        $isLoggedIn = isset($_SESSION['user_id']);
        ?>
        <a href="login.php">
            <button class="image-button" id="profile-button">
                <img src="Vector2.png" alt="Польз">
            </button>
        </a>
    </div>  
    <h3 class="title">Личный кабинет</h3>
    <div class="cab">
        <div class="profiel">
            <button class="image-button-notification">
                <img src="uved.svg" alt="Кнопка 4" />
            </button>
            <div class="image-container1">
                <img src="pfp.svg" alt="Товар 1" class="product-image">
            </div>
            <div class="Name"><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Гость'; ?></div>
        </div>
        <div class="button-grid">
            <button class="grid-button">
                <a href="settings.php"><img src="dp.svg" alt="Доставка" class="button-icon" /></a>
                Доставка
            </button>
            <button class="grid-button">
                <a href="settings.php"> <img src="dp.svg" alt="Покупка" class="button-icon" /></a>
                Покупка
            </button>
            <button class="grid-button">
                <a href="settings.php"><img src="controls.svg" alt="Настройка" class="button-icon" /></a>
                Настройки
            </button>
            <button class="grid-button">
                <a href="settings.php"><img src="chat-bubble.svg" alt="Поддержка" class="button-icon" /></a>
                Поддержка
            </button>
        </div>
    </div>

    <h3 class="title">Вы смотрели</h3>
    <?php
    if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) {
        echo '<button onclick="window.location.href=\'adm1.php\'">Админ панель</button>';
    }
    ?>
    <div class="recommendations">
    <?php 
    // Получаем идентификаторы просмотренных товаров из сессии
    $viewed_products = isset($_SESSION['viewed_products']) ? $_SESSION['viewed_products'] : [];

    // Преобразуем массив в строку для SQL-запроса
    if (!empty($viewed_products)) {
        $viewed_ids = implode(',', array_map('intval', $viewed_products)); // Преобразуем в строку и защищаем от SQL-инъекций
        $sql = "SELECT * FROM product p JOIN Category c ON p.`category_id` = c.`category_id` WHERE p.product_id IN ($viewed_ids) LIMIT 4;";
    } else {
        // Если нет просмотренных товаров, можно вывести сообщение или ничего не выводить
        echo '<p>Вы еще не смотрели ни один товар.</p>';
        exit; // Завершаем выполнение скрипта
    }

    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        echo '<a href="Product page.php?id=' . $row['product_id'] . '">
        <div class="product">
                    <div class="image-container">
                        <img src="'.$row['img'].'" alt="Товар 1" class="product-image">
                        <div class="discount-text">-50%</div>
                    </div>
                    <div class="product-info">
                        <div class="product-button-top-right">
                            <img src="Vector3.svg" alt="Кнопка 5" />
                        </div>
                        <div class="product-name">'.$row['title'].'</div>
                        <div class="product-somthing">'.$row['category_name'].'</div>
                        <div class="product-somthing">'.$row['weight'].' г</div>
                        <div class="product-price-and-button">
                            <div class="product-price">'.($row['price']/100*$row['discount']).'₽</div>
                            <div class="product-price2">'.$row['price'].' ₽</div>
                            <button class="image-button-cart">
                                <img src="Vector1.png" alt="Кнопка 4" />
                            </button>
                        </div>
                    </div>
                </div>';
    }

    // Получаем идентификатор товара из URL
    $product_id = $_GET['id'];

    // Проверяем, существует ли сессия для просмотренных товаров
    if (!isset($_SESSION['viewed_products'])) {
        $_SESSION['viewed_products'] = [];
    }

    // Добавляем идентификатор товара в сессию, если его там еще нет
    if (!in_array($product_id, $_SESSION['viewed_products'])) {
        $_SESSION['viewed_products'][] = $product_id;
    }
    ?>  
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
                <a href="Privacy Policy.php">Конвидициальность</a>
                <a href="Rules.php">Технологии</a>
            </div>
        </div>
    </div>
</body>
</html>