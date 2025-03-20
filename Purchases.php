<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Покупки</title>
    <link rel="stylesheet" href="Purchases.css">
</head>
<body>
    <div class="attic">
        <div class="logo"><img src="A&A.svg" alt="Логотип"></div>
        <input type="text" class="search-input" placeholder="Название товара/категория...">
        <button class="button catalog">Каталог</button>
        <button class="image-button">
            <img src="Vector.png" alt="Кнопка 1" />
        </button>
        <button class="image-button">
            <img src="Vector1.png" alt="Кнопка 2" />
        </button>
        <button class="image-button">
            <img src="Vector2.png" alt="Кнопка 3" />
        </button>
    </div>
    <h3 class="title">Доставка</h3>
<h3 class="title-right">Покупки</h3>
<?php 
include 'db.php';
$sql = "SELECT * FROM product p JOIN Category c ON p.`category_id` = c.`category_id` limit 12;
";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()){
    echo '   <a href="Product page.php?id=' . $row['product_id'] . '">
    <div class="product">
                <div class="image-container">
                    <img src="'.$row['img'].'" class="product-image">
                    <div class="discount-text">-50%</div>
                </div>
                <div class="product-info">
                    <div class="product-button-top-right">
                        <img src="Vector3.svg" " />
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