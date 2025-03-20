<?php
session_start();

// Если пользователь не авторизован, присваиваем роль "Гость"
if (!isset($_SESSION['role_id'])) {
    $_SESSION['role_id'] = 3; // Роль "Гость"
}

// Проверка роли пользователя
$isAdmin = ($_SESSION['role_id'] == 1); // Предположим, что роль администратора имеет ID = 1
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    <link rel="stylesheet" href="Main.css">
    <script src="search.js"></script>
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

    <div style="position: relative;" class="banner">
        <img src="banner1.svg" alt="" style="width: 100%;">
        <img src="baner2.svg" alt="" style="position: absolute; top: 0; left: 0;">
        <div class="banner-text">
            <h1>Скидки</h1>
            <h3>50%</h3>
            <h5>на шоколадные плитки!</h5>
        </div>
    </div>

    <?php
    // Проверка роли пользователя
    if ($_SESSION['role_id'] == 3) {
        echo "<p> <a href='login.php'></a><a href='register.php'></a>.</p>";
    } else {
        echo "<p>Добро пожаловать, пользователь!</p>";
        echo "<a href='logout.php'>Выйти</a>";
    }
    ?>

    <h3 class="title">Рекомендации</h3>
    <div id="recommendations" class="recommendations">
        <?php
        include 'db.php'; // Подключение к базе данных

        // Получение всех товаров
        $sql = "SELECT * FROM product p 
                JOIN Categories c ON p.category_id = c.category_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        // Генерация HTML-кода для всех товаров
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<a href="product page.php?id=' . $row['product_id'] . '" class="product-link">
                <div class="product" data-id="'.$row['product_id'].'" data-title="'.strtolower($row['title']).'" data-category="'.strtolower($row['category_name']).'">
                    <div class="image-container">
                        <img src="'.$row['img'].'" alt="Товар 1" class="product-image">
                        <div class="discount-text">-50%</div>
                    </div>
                    <div class="product-info">
                        <div class="product-button-top-right" onclick="addToFavorites('.$row['product_id'].')">
                            <img src="Vector3.svg" alt="Добавить в избранное" />
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
                </div>
              </a>';
            }
        } else {
            echo '<p>Товары не найдены.</p>';
        }

        $stmt->close();
        $conn->close();
        ?>
    </div>

    <h3 class="title1">О нас</h3>
    <div class="aboutus-container">
        <div class="aboutus-background">
            <div class="background-shape">
                <p class="text-aboutus1">Добро пожаловать в мир изысканных шоколадных изделий ручной работы от A&A! Наша компания была основана с любовью к шоколаду и стремлением создавать уникальные сладости, которые радуют и вдохновляют.</p>
                <p class="text-aboutus2">Мы верим, что шоколад — это не просто сладость, а искусство. Наша миссия заключается в том, чтобы каждый кусочек шоколада приносил радость и удовлетворение. Мы используем только лучшие ингредиенты, отборные какао-бобы и натуральные добавки, чтобы создать шоколад, который не только вкусен, но и полезен.</p>
                <img src="image.svg" alt="Фото" class="img1">
                <img src="image1.svg" alt="Фото 1" class="img2">
            </div>
        </div>
    </div>

    <div class="why-background">
        <div class="content-container">
            <h3 class="title2">Почему именно мы?</h3>
            <div class="images-container">
                <div class="image-wrapper">
                    <img src="why1.svg" alt="Что-то 1" class="why-image">
                    <div class="image-text">
                        <p>Только качественный шоколад!</p>
                    </div>
                </div>
                <div class="image-wrapper">
                    <img src="why2.svg" alt="Что-то 2" class="why-image">
                    <div class="image-text">
                        <p>Товары на любой вкус</p>
                    </div>
                </div>
                <div class="image-wrapper">
                    <img src="why3.svg" alt="Что-то 3" class="why-image">
                    <div class="image-text">
                        <p>Товары ручной работы</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Подвал -->
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
                <a href="Privacy Policy.php">Конфиденциальность</a>
                <a href="Rules.php">Технологии</a>
            </div>
            <?php if ($isAdmin): ?>
                <div class="column">
                    <h4>Администрирование</h4>
                    <a href="adm1.php">Админ-панель</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="js/reg.js"></script>
</body>
</html>