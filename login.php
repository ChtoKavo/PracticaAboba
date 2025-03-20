<?php
session_start(); // Начинаем сессию

// Подключение к базе данных
$host = 'localhost'; // Хост базы данных
$dbname = 'PR2'; // Имя базы данных
$username = 'root'; // Имя пользователя базы данных
$password = 'Und_ofg'; // Пароль пользователя базы данных

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}

// Проверяем, была ли отправлена форма
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получение данных из формы
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Поиск пользователя в базе данных
    $stmt = $conn->prepare("SELECT * FROM Users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Проверка пароля
        if ($password === $user['pass']) { // В реальных проектах используйте password_verify() для хэшированных паролей
            // Успешный вход
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role_id'] = $user['role_id'];

            // Перенаправление на личный кабинет в зависимости от роли
            if ($user['role_id'] == 1) {
                header("Location: adm1.php"); // Перенаправление для администратора
            } else {
                header("Location: Personal account.php"); // Перенаправление для обычного пользователя
            }
            exit();
        } else {
            // Неверный пароль
            echo "Неверный пароль. <a href='login.html'>Попробуйте снова</a>.";
        }
    } else {
        // Пользователь не найден
        echo "Пользователь с таким email не найден. <a href='register.php'>Зарегистрируйтесь</a>.";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="login.css">
    <title>Вход</title>
</head>
<body>
    <div class="auth-container">
        <h2>Вход</h2>
        <form action="login.php" method="POST" onsubmit="return validateForm()">
            <input type="email" name="email" placeholder="Email" maxlength="50" required>
            <input type="password" name="password" placeholder="Пароль" minlength="3" maxlength="10" required>
            <button type="submit">Войти</button>
        </form>
        <p class="register-link">
            Нет аккаунта? <a href="register.php">Зарегистрируйтесь</a>
        </p>
    </div>

    <script>
        function validateForm() {
            const email = document.forms[0]["email"].value;
            const password = document.forms[0]["password"].value;

            // Проверка длины email
            if (email.length > 50) {
                alert("Email должен содержать не более 50 символов.");
                return false;
            }

            // Проверка длины пароля
            if (password.length < 3 || password.length > 10) {
                alert("Пароль должен содержать от 3 до 10 символов.");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>