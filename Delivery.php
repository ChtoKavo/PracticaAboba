<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Доставка</title>
    <link rel="stylesheet" href="Delivery.css">
</head>
<body>
    <div class="attic">
        <div class="logo"> <a href="Main.php">
            <img src="A&A.svg" alt="Логотип">
        </a></div>
           <!-- Ваше поле ввода -->
           <input type="text" class="search-input" id="searchInput" placeholder="Название товара/категория...">

        

<script src="js/search.js"></script>

        <button class="button catalog">Каталог</button>
        <button class="image-button">

<a href="Favourites.php"><img src="Vector.png" alt="Избр">
</button><a>
<a href="Cart.php" ><button class="image-button">
    <img src="Vector1.png" alt="Корз" >
</button><a>
</a>
<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
?>

<!-- Кнопка профиля -->
<a href="login.php">
<button class="image-button" id="profile-button">
<img src="Vector2.png" alt="Польз">
</button>
</a>
</div>
    <h3 class="title">Доставка</h3>
<h3 class="title-right">Покупки</h3>
    <div class="recommendations">
<div class="product">
    <div class="image-container">
        <img src="product1.svg" alt="Товар 1" class="product-image">
    </div>
    <div class="product-info">
        <div class="product-name">Черная магия</div>
        <div class="product-somthing">Шоколадные кофеты</div>
        <div class="product-somthing">365 г</div>
        <div class="product-price-and-button">
            <div class="product-price">На сборе</div>
        </div>
    </div>
</div>
<div class="product">
    <div class="image-container">
        <img src="product1.svg" alt="Товар 1" class="product-image">
    </div>
    <div class="product-info">
        <div class="product-name">Черная магия</div>
        <div class="product-somthing">Шоколадные кофеты</div>
        <div class="product-somthing">365 г</div>
        <div class="product-price-and-button">
            <div class="product-price">Доставлен</div>
        </div>
    </div>
</div>
<div class="product">
    <div class="image-container">
        <img src="product1.svg" alt="Товар 1" class="product-image">
    </div>
    <div class="product-info">
        <div class="product-name">Черная магия</div>
        <div class="product-somthing">Шоколадные кофеты</div>
        <div class="product-somthing">365 г</div>
        <div class="product-price-and-button">
            <div class="product-price">Едет в пункт назначения</div>
        </div>
    </div>
</div>
<div class="product">
    <div class="image-container">
        <img src="product1.svg" alt="Товар 1" class="product-image">
    </div>
    <div class="product-info">
        <div class="product-name">Черная магия</div>
        <div class="product-somthing">Шоколадные кофеты</div>
        <div class="product-somthing">365 г</div>
        <div class="product-price-and-button">
            <div class="product-price">Готовиться</div>
        </div>
    </div>
</div>
<div class="product">
    <div class="image-container">
        <img src="product1.svg" alt="Товар 1" class="product-image">
    </div>
    <div class="product-info">
        <div class="product-name">Черная магия</div>
        <div class="product-somthing">Шоколадные кофеты</div>
        <div class="product-somthing">365 г</div>
        <div class="product-price-and-button">
            <div class="product-price">На сборе</div>
        </div>
    </div>
</div>
<div class="product">
    <div class="image-container">
        <img src="product1.svg" alt="Товар 1" class="product-image">
    </div>
    <div class="product-info">
        <div class="product-name">Черная магия</div>
        <div class="product-somthing">Шоколадные кофеты</div>
        <div class="product-somthing">365 г</div>
        <div class="product-price-and-button">
            <div class="product-price">Доставлен</div>
        </div>
    </div>
</div>
<div class="product">
    <div class="image-container">
        <img src="product1.svg" alt="Товар 1" class="product-image">
    </div>
    <div class="product-info">
        <div class="product-name">Черная магия</div>
        <div class="product-somthing">Шоколадные кофеты</div>
        <div class="product-somthing">365 г</div>
        <div class="product-price-and-button">
            <div class="product-price">Едет в пункт назначения</div>
        </div>
    </div>
</div>
<div class="product">
    <div class="image-container">
        <img src="product1.svg" alt="Товар 1" class="product-image">
    </div>
    <div class="product-info">
        <div class="product-name">Черная магия</div>
        <div class="product-somthing">Шоколадные кофеты</div>
        <div class="product-somthing">365 г</div>
        <div class="product-price-and-button">
            <div class="product-price">Готовиться</div>
        </div>
    </div>
</div>

<div class="product">
    <div class="image-container">
        <img src="product1.svg" alt="Товар 1" class="product-image">
    </div>
    <div class="product-info">
        <div class="product-name">Черная магия</div>
        <div class="product-somthing">Шоколадные кофеты</div>
        <div class="product-somthing">365 г</div>
        <div class="product-price-and-button">
            <div class="product-price">На сборе</div>
        </div>
    </div>
</div>
<div class="product">
    <div class="image-container">
        <img src="product1.svg" alt="Товар 1" class="product-image">
    </div>
    <div class="product-info">
        <div class="product-name">Черная магия</div>
        <div class="product-somthing">Шоколадные кофеты</div>
        <div class="product-somthing">365 г</div>
        <div class="product-price-and-button">
            <div class="product-price">Доставлен</div>
        </div>
    </div>
</div>
<div class="product">
    <div class="image-container">
        <img src="product1.svg" alt="Товар 1" class="product-image">
    </div>
    <div class="product-info">
        <div class="product-name">Черная магия</div>
        <div class="product-somthing">Шоколадные кофеты</div>
        <div class="product-somthing">365 г</div>
        <div class="product-price-and-button">
            <div class="product-price">Едет в пункт назначения</div>
        </div>
    </div>
</div>
<div class="product">
    <div class="image-container">
        <img src="product1.svg" alt="Товар 1" class="product-image">
    </div>
    <div class="product-info">
        <div class="product-name">Черная магия</div>
        <div class="product-somthing">Шоколадные кофеты</div>
        <div class="product-somthing">365 г</div>
        <div class="product-price-and-button">
            <div class="product-price">Готовиться</div>
        </div>
    </div>
</div>

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
        < class="social-media">
            <img src="odnoklassniki.svg" alt="Odnokla
        <div class="social-media">
            <img src="tg.svg" alt="Telegram" class="image-button2">
        </div>
        <div class="social-media">
            <img src="youtube.svg" alt="YouTube" class="image-button2">
        </div>
    </div>
    <div class="footer-text">
        <p>© A&A 2025. Все права защищены.
            Применяются рекомендательные технологии</p>
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