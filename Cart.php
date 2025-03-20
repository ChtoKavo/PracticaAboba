<?php
session_start();
include __DIR__ . '/db.php';

if (!isset($_SESSION['user_id'])) {
    echo '<p>Пожалуйста, авторизуйтесь, чтобы просмотреть корзину.</p>';
    exit;
}

$user_id = $_SESSION['user_id'];
$total = 0;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Корзина</title>
    <link rel="stylesheet" href="Cart.css">
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

    <h3 class="title">Корзина</h3>
    <div class="recommendations">
        <label class="all"> 
            <input type="checkbox" name="all"> Выбрать все
        </label>

        <div class="product-container">
        <?php
        try {
            $stmt = $conn->prepare("
                SELECT p.product_id, p.title, p.discounted_price, p.img, c.quantity 
                FROM Cart c 
                JOIN Product p ON c.product_id = p.product_id 
                WHERE c.user_id = ?
            ");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
        
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $discounted_price = $row['discounted_price'];
                    $quantity = $row['quantity'];
                    $total += $discounted_price * $quantity;
        
                    echo '<div class="product">
                            <div class="image-container">
                                <img src="' . $row['img'] . '" alt="' . $row['title'] . '" class="product-image">
                                <button class="image-button-cart" onclick="removeFromCart(' . $row['product_id'] . ')">
                                    <img src="del.svg" alt="Удалить" />
                                </button>
                            </div>
                            <div class="product-info">
                                <div class="product-name">' . $row['title'] . '</div>
                                <div class="product-price">' . $discounted_price . ' ₽</div>
                                <div class="quantity-control">
                                    <button class="quantity-button minus" onclick="updateQuantity(' . $row['product_id'] . ', ' . ($quantity - 1) . ')">-</button>
                                    <span class="quantity">' . $quantity . '</span>
                                    <button class="quantity-button plus" onclick="updateQuantity(' . $row['product_id'] . ', ' . ($quantity + 1) . ')">+</button>
                                </div>
                            </div>
                          </div>';
                }
            } else {
                echo '<p>Ваша корзина пуста.</p>';
            }
        } catch (Exception $e) {
            echo '<p>Ошибка: ' . $e->getMessage() . '</p>';
        }
        ?>
        </div>
        <div class="filtr">
            <div class="background-shape">
                <button class="image-button1">
                    <img src="edit.svg" alt="Кнопка"/>
                </button>
                <h4 class="text1">Адрес доставки:</h4>
                <p class="text1-data">ул. Примерная, д. 123, кв. 45</p>
                <h4 class="text2">Данные получателя:</h4>
                <p class="text2-data">Иванов Иван Иванович, +7 (123) 456-78-90</p>
                <h4 class="text3">Способы оплаты:</h4>
                <div class="special-offers">
                    <label class="special-offer-option">
                        <input type="checkbox" name="special-offer" value="discount" class="hidden-checkbox">
                        <img src="sber.svg" alt="SberPay Icon">
                        <span>SberPay</span>
                    </label>
                    <label class="special-offer-option">
                        <input type="checkbox" name="special-offer" value="new" class="hidden-checkbox">
                        <img src="t-bank.svg" alt="Tinkoff Pay Icon">
                        <span>Tinkoff Pay</span>
                    </label>
                    <label class="special-offer-option">
                        <input type="checkbox" name="special-offer" value="limited" class="hidden-checkbox">
                        <img src="carta.svg" alt="Card Icon">
                        <span>Картой</span>
                    </label>
                </div>
                <p class="text3-data">Доставка: <span class="text3-data-value">+200 ₽</span></p>
                <p class="text3-data1">Итог: <span class="text3-data1-value"><?php echo $total + 200; ?> ₽</span></p>
                <button class="button2">Оплатить</button>
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
       function removeFromCart(productId) {
    fetch('remove_from_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ product_id: productId }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Товар удален из корзины!');
            location.reload();
        } else {
            alert('Ошибка: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Ошибка:', error);
    });
}
    </script>
</body>
</html>


