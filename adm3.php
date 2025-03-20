<?php

session_start();
// Подключение к базе данных
$servername = 'localhost';
$dbname = 'pr2';
$username = 'root';
$password = 'Und_ofg';

try {
    // Подключение к базе данных
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}

// Обработка добавления товара
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $weight = $_POST['weight'];
    $composition = $_POST['composition'];
    $expiration_date = $_POST['expiration_date'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $discount = $_POST['discount'];
    $discounted_price = $_POST['discounted_price'];

    // Валидация данных
    if (empty($title) || empty($price) || empty($category_id)) {
        echo "<script>alert('Пожалуйста, заполните все обязательные поля.');</script>";
    } else {
        // Вставка данных в таблицу Product
        $sql = "INSERT INTO product (title, description, weight, composition, expiration_date, price, category_id, discount, discounted_price) 
                VALUES (:title, :description, :weight, :composition, :expiration_date, :price, :category_id, :discount, :discounted_price)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':title' => $title,
            ':description' => $description,
            ':weight' => $weight,
            ':composition' => $composition,
            ':expiration_date' => $expiration_date,
            ':price' => $price,
            ':category_id' => $category_id,
            ':discount' => $discount,
            ':discounted_price' => $discounted_price
        ]);

        echo "<script>alert('Товар успешно добавлен!');</script>";
    }
}

// Обработка добавления категории
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_category'])) {
    $categoryName = $_POST['categoryName'];
    $categoryDescription = $_POST['categoryDescription'];

    // Вставка данных в таблицу Categories
    $sql = "INSERT INTO categories (category_name, description) VALUES (:category_name, :description)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':category_name' => $categoryName,
        ':description' => $categoryDescription
    ]);

    echo "<script>alert('Категория успешно добавлена!');</script>";
}

// Обработка удаления товара
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_product'])) {
    $product_id = $_POST['product_id'];

    try {
        // Удаление товара из таблицы product
        $sql = "DELETE FROM product WHERE product_id = :product_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':product_id' => $product_id]);

        echo "<script>alert('Товар успешно удален!');</script>";
        echo "<script>window.location.href = 'adm3.php';</script>"; // Перезагрузка страницы
    } catch (PDOException $e) {
        echo "<script>alert('Ошибка при удалении товара: " . $e->getMessage() . "');</script>";
    }
}

// Обработка удаления категории
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_category'])) {
    $category_id = $_POST['category_id'];

    try {
        // Удаление категории из таблицы categories
        $sql = "DELETE FROM categories WHERE category_id = :category_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':category_id' => $category_id]);

        echo "<script>alert('Категория успешно удалена!');</script>";
        echo "<script>window.location.href = 'adm3.php';</script>"; // Перезагрузка страницы
    } catch (PDOException $e) {
        echo "<script>alert('Ошибка при удалении категории: " . $e->getMessage() . "');</script>";
    }
}

// Получение списка товаров
$sql = "SELECT product_id, title, category_id, price FROM product";
$stmt = $pdo->query($sql);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Получение списка категорий
$sql = "SELECT category_id, category_name, description FROM categories";
$stmt = $pdo->query($sql);
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="adm3.css">
    <link href="https://fonts.googleapis.com/css2?family=Etude+Noire&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ панель</title>
</head>
<body>

<!-- Левая панель -->
<div class="sidebar">
    <h1>Админ панель</h1>
    <h3><a href="adm1.php">Заказы</a></h3>
    <h3><a href="adm2.php">Пользователи</a></h3>
    <h3><a href="adm3.php">Товары</a></h3>
    <button class="logout-button">Выход</button>
</div>

<!-- Основной контент -->
<div class="content">
    <!-- Список товаров -->
    <h2>Список товаров</h2>
    <div class="outer-block">
        <table>
            <tr>
                <th>ID товара</th>
                <th>Название</th>
                <th>Категория</th>
                <th>Цена</th>
                <th>Действие</th>
            </tr>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?= htmlspecialchars($product['product_id']) ?></td>
                <td><?= htmlspecialchars($product['title']) ?></td>
                <td><?= htmlspecialchars($product['category_id']) ?></td>
                <td><?= htmlspecialchars($product['price']) ?></td>
                <td>
                    <form method="POST" action="" style="display:inline;">
                        <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                        <button type="submit" name="delete_product">Удалить</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <!-- Список категорий -->
    <h2>Список категорий</h2>
    <div class="outer-block">
        <table>
            <tr>
                <th>ID категории</th>
                <th>Название</th>
                <th>Описание</th>
                <th>Действие</th>
            </tr>
            <?php foreach ($categories as $category): ?>
            <tr>
                <td><?= htmlspecialchars($category['category_id']) ?></td>
                <td><?= htmlspecialchars($category['category_name']) ?></td>
                <td><?= htmlspecialchars($category['description']) ?></td>
                <td>
                    <form method="POST" action="" style="display:inline;">
                        <input type="hidden" name="category_id" value="<?= $category['category_id'] ?>">
                        <button type="submit" name="delete_category">Удалить</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <!-- Форма добавления товара -->
    <h2>Создать товар</h2>
    <div class="outer-block0">
        <form method="POST" action="">
            <div class="input-container">
                <input type="text" name="title" placeholder="Название товара" required>
                <input type="text" name="weight" placeholder="Вес товара" required>
                <input type="text" name="price" placeholder="Цена товара" required>
                <input type="text" name="expiration_date" placeholder="Срок годности" required>
                <input type="text" name="composition" placeholder="Состав товара" required>
                <input type="text" name="discount" placeholder="Скидка (например, 0.10 для 10%)">
                <input type="text" name="discounted_price" placeholder="Цена со скидкой">
                
                <!-- Выбор категории -->
                <select name="category_id" required>
                    <option value="">Выберите категорию</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= htmlspecialchars($category['category_id']) ?>">
                            <?= htmlspecialchars($category['category_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="input-container2">
                <textarea style="height: 180px;" name="description" placeholder="Описание" required></textarea>
            </div>

            <button type="submit" name="add_product" class="logout-button2">Добавить товар</button>
        </form>
    </div>

    <!-- Форма добавления категории -->
    <h2>Создать категорию</h2>
    <button class="add-category-button" onclick="openModal()">Добавить категорию</button>

    <!-- Модальное окно для добавления категории -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Добавить категорию</h2>
            <form method="POST" action="">
                <input type="text" name="categoryName" placeholder="Название категории" required>
                <input type="text" name="categoryDescription" placeholder="Описание категории" required>
                <button type="submit" name="add_category">Добавить категорию</button>
            </form>
        </div>
    </div>
</div>

<script>
// Функции для открытия и закрытия модального окна
function openModal() {
    document.getElementById("modal").style.display = "block";
}

function closeModal() {
    document.getElementById("modal").style.display = "none";
}

// Валидация формы добавления товара
document.querySelector('form').addEventListener('submit', function(event) {
    let title = document.querySelector('input[name="title"]').value;
    let price = document.querySelector('input[name="price"]').value;
    let category_id = document.querySelector('select[name="category_id"]').value;

    if (!title || !price || !category_id) {
        alert('Пожалуйста, заполните все обязательные поля.');
        event.preventDefault();
    }
});
</script>

</body>
</html>