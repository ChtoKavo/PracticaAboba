<?php
session_start();
include 'db.php'; // Подключение к базе данных

// Получение параметров фильтрации и сортировки из GET-запроса
$sortBy = isset($_GET['sort']) ? $_GET['sort'] : 'price_asc';
$showDiscount = isset($_GET['discount']) ? true : false;
$showNew = isset($_GET['new']) ? true : false;
$showLimited = isset($_GET['limited']) ? true : false;

// Формирование SQL-запроса
$sql = "SELECT * FROM product p 
        JOIN Categories c ON p.category_id = c.category_id 
        WHERE 1=1";

// Добавление условий фильтрации
if ($showDiscount) {
    $sql .= " AND p.discount > 0";
}
if ($showNew) {
    $sql .= " AND p.is_new = 1";
}
if ($showLimited) {
    $sql .= " AND p.is_limited = 1";
}

// Добавление сортировки
if ($sortBy === 'price_asc') {
    $sql .= " ORDER BY p.price ASC";
} elseif ($sortBy === 'price_desc') {
    $sql .= " ORDER BY p.price DESC";
}

// Выполнение запроса
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог</title>
    <link rel="stylesheet" href="Catalog.css">
</head>
<body>
<div class="attic">
        <div class="logo">
            <a href="Main.php">
                <img src="A&A.svg" alt="Логотип">
            </a>
        </div>
        <input type="text" class="search-input" id="searchInput" placeholder="Название товара/категория...">
        <script src="js/search.js"></script>
        <button class="button catalog">Каталог</button>
        <button class="image-button">
            <a href="Favourites.php"><img src="Vector.png" alt="Избр"></a>
        </button>
        <button class="image-button">
            <a href="Cart.php"><img src="Vector1.png" alt="Корз"></a>
        </button>
        <a href="login.php">
            <button class="image-button" id="profile-button">
                <img src="Vector2.png" alt="Польз">
            </button>
        </a>
    </div>

    <?php
    $isLoggedIn = isset($_SESSION['user_id']);
    ?>

    
</div>

<h3 class="title">Каталог</h3>
<div class="recommendations">
    <div class="filtr">
        <div class="background-shape">
            <!-- Фильтры и сортировка -->
            <form method="GET" action="Catalog.php">
                <h4 class="text1">Сортировка по:</h4>
                <select class="choice-shape" name="sort">
                    <option value="price_asc" <?= $sortBy === 'price_asc' ? 'selected' : '' ?>>Цена по возрастанию</option>
                    <option value="price_desc" <?= $sortBy === 'price_desc' ? 'selected' : '' ?>>Цена по убыванию</option>
                </select>
                <h4 class="text3">Специальное предложение:</h4>
                <div class="special-offers">
                    <label class="special-offer-option">
                        <input type="checkbox" name="discount" <?= $showDiscount ? 'checked' : '' ?>> Скидки
                    </label>
                    <label class="special-offer-option">
                        <input type="checkbox" name="new" <?= $showNew ? 'checked' : '' ?>> Новинки
                    </label>
                    <label class="special-offer-option">
                        <input type="checkbox" name="limited" <?= $showLimited ? 'checked' : '' ?>> Ограниченный тираж
                    </label>
                </div>
                <button type="submit">Применить</button>
            </form>
        </div>
    </div>

    <!-- Контейнер для товаров -->
    <div class="product-container" id="product-container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<a href="product page.php?id=' . $row['product_id'] . '" class="product-link">
                <div class="product" data-id="' . $row['product_id'] . '" data-title="' . strtolower($row['title']) . '" data-category="' . strtolower($row['category_name']) . '">
                    <div class="image-container">
                        <img src="' . $row['img'] . '" alt="Товар 1" class="product-image">
                        ' . ($row['discount'] > 0 ? '<div class="discount-text">-' . $row['discount'] . '%</div>' : '') . '
                    </div>
                    <div class="product-info">
                        <div class="product-button-top-right" onclick="addToFavorites(' . $row['product_id'] . ')">
                            <img src="Vector3.svg" alt="Добавить в избранное" />
                        </div>
                        <div class="product-name">' . $row['title'] . '</div>
                        <div class="product-somthing">' . $row['category_name'] . '</div>
                        <div class="product-somthing">' . $row['weight'] . ' г</div>
                        <div class="product-price-and-button">
                            <div class="product-price">' . ($row['price'] / 100 * (100 - $row['discount'])) . '₽</div>
                            ' . ($row['discount'] > 0 ? '<div class="product-price2">' . $row['price'] . ' ₽</div>' : '') . '
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
        ?>
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
   document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const productLinks = document.querySelectorAll('.product-link');

    searchInput.addEventListener('input', function() {
        const searchText = searchInput.value.trim().toLowerCase(); // Приводим введенный текст к нижнему регистру и удаляем лишние пробелы

        productLinks.forEach(function(productLink) {
            const product = productLink.querySelector('.product');
            const productTitle = product.getAttribute('data-title').toLowerCase(); // Приводим название товара к нижнему регистру
            const productCategory = product.getAttribute('data-category').toLowerCase(); // Приводим категорию товара к нижнему регистру

            // Проверяем, содержит ли название товара или категории введенный текст
            if (productTitle.includes(searchText) || productCategory.includes(searchText)) {
                productLink.style.display = 'block'; // Показываем товар, если он соответствует поиску
            } else {
                productLink.style.display = 'none'; // Скрываем товар, если он не соответствует поиску
            }
        });
    });
});
</script>
</body>
</html>