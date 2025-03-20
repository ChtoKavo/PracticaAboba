<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Настройки</title>
    <link rel="stylesheet" href="Settings.css">
</head>
<body>
    <div class="attic">
        <div class="logo"> <a href="Main.php">
            <img src="A&A.svg" alt="Логотип">
        </a></div>
     <!-- Ваше поле ввода -->
     <input type="text" class="search-input" id="searchInput" placeholder="Название товара/категория...">

     <?php
require 'check_access.php';
checkAccess(2); // Только для пользователей (role_id >= 2)

// Ваш код для страницы профиля
?>

<script src="js/search.js"></script>


        <button class="button catalog">Каталог</button>
        <button class="image-button">
            <img src="Vector.png" alt="Кнопка 1" />
        </button>
        <button class="image-button">
            <img src="Vector1.png" alt="Кнопка 2" />
        </button>
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
    <h3 class="title">Настройки</h3>
    <div class="cab">
        <div class="profile-container">
            <div class="columns-container">
                <div class="image-container1">
                    <img src="pfp.svg" alt="Profile Picture" class="product-image">
                </div>
                <div class="profile-details">
                    <div class="Name">Ильина Анна Алексеевна</div>
                    <div class="profile-info">
                        <div class="info-item">
                            <span>Дата рождения:</span>
                            <span>01.01.1990</span>
                        </div>
                        <div class="info-item">
                            <span>Пол:</span>
                            <span>Женский</span>
                        </div>
                    </div>
                    <div class="credentials">
                        <div class="info-item">
                            <span>Телефон:</span>
                            <span>+7 (123) 456-78-90</span>
                        </div>
                        <div class="info-item">
                            <span>Почта:</span>
                            <span>anna.ilina@example.com</span>
                        </div>
                    </div>
                    <div class="action-button-container">
                        <button class="action-button">Изменить</button>
                    </div>
                 <!-- Модальное окно -->
                 <div id="editProfileModal" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="closeModal()">&times;</span>
                            <h2>Изменить профиль</h2>
                            <form id="editProfileForm" onsubmit="return updateProfile(event)">
                                <label for="name">Имя:</label>
                                <input type="text" id="name" name="name" value="Ильина Анна Алексеевна" required>
                                <label for="dob">Дата рождения:</label>
                                <input type="date" id="dob" name="dob" value="1990-01-01" required>
                                <label for="gender">Пол:</label>
                                <select id="gender" name="gender" required>
                                    <option value="Женский">Женский</option>
                                    <option value="Мужской">Мужской</option>
                                </select>
                                <label for="phone">Телефон:</label>
                                <input type="tel" id="phone" name="phone" value="+7 (123) 456-78-90" required>
                                <label for="email">Почта:</label>
                                <input type="email" id="email" name="email" value="anna.ilina@example.com" required>
                                <button type="submit">Сохранить изменения</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="account-management">
                    <h4 class="section-title">Управление аккаунтом</h4>
                    <div class="info-item">
                        <button class="delete-account-button">Удалить аккаунт</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function updateProfile(event) {
            event.preventDefault(); // Prevents page reload

            const formData = new FormData(document.getElementById('editProfileForm'));
            console.log('Form Data:', Object.fromEntries(formData)); // Log form data for debugging

            fetch('update_profile.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Профиль успешно обновлен!');
                    
                    // Update information on the page
                    document.querySelector('.Name').textContent = document.getElementById('name').value;
                    document.querySelector('.profile-info .info-item:nth-child(1) span:nth-child(2)').textContent = document.getElementById('dob').value;
                    document.querySelector('.profile-info .info-item:nth-child(2) span:nth-child(2)').textContent = document.getElementById('gender').value;
                    document.querySelector('.credentials .info-item:nth-child(1) span:nth-child(2)').textContent = document.getElementById('phone').value;
                    document.querySelector('.credentials .info-item:nth-child(2) span:nth-child(2)').textContent = document.getElementById('email').value;

                    closeModal();
                } else {
                    alert('Ошибка при обновлении профиля: ' + (data.error || ''));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Ошибка при обновлении профиля.');
            });
        }
    </script>


<?php
// Start the session at the very beginning

$_SESSION['user_id'] = $user_id; // Set the user ID
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'User not logged in']);
    exit;
}
include 'db.php';

// Получение данных из POST-запроса
$name = $_POST['name'] ?? null;
$dob = $_POST['dob'] ?? null;
$gender = $_POST['gender'] ?? null;
$phone = $_POST['phone'] ?? null;
$email = $_POST['email'] ?? null;

// Получение идентификатора пользователя из сессии
$userId = $_SESSION['user_id'] ?? null;

if (!$userId) {
    echo json_encode(['success' => false, 'error' => 'User not logged in']);
    exit;
}

// Подготовка и привязка
$stmt = $conn->prepare("UPDATE Users SET username=?, dob=?, gender=?, phone=?, email=? WHERE user_id=?");
$stmt->bind_param("sssssi", $name, $dob, $gender, $phone, $email, $userId);

// Выполнение запроса
if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $stmt->error]);
}

// Закрытие соединений
$stmt->close();
$conn->close();
?>


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
        </div>
    </div>
</body>
</html>