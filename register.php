<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" href="reg.css">
</head>
<body>
    <div class="auth-container">
        <h2>Регистрация</h2>
        <form id="register-form" action="register_process.php" method="POST" onsubmit="return validateForm()">
            <input type="text" name="username" placeholder="Имя пользователя" minlength="3" maxlength="30" required>
            <input type="email" name="email" placeholder="Email" maxlength="50" required>
            <input type="password" name="password" placeholder="Пароль" minlength="3" maxlength="10" required>
            <input type="password" name="confirm-password" placeholder="Повторите пароль" minlength="3" maxlength="10" required>
            <button type="submit">Зарегистрироваться</button>
        </form>
        <p class="login-link">
            Уже есть аккаунт? <a href="login.php">Войдите</a>
        </p>
    </div>
    <script>
        function validateForm() {
            const username = document.forms["register-form"]["username"].value;
            const email = document.forms["register-form"]["email"].value;
            const password = document.forms["register-form"]["password"].value;
            const confirmPassword = document.forms["register-form"]["confirm-password"].value;

            // Проверка длины имени пользователя
            if (username.length < 3 || username.length > 30) {
                alert("Имя пользователя должно содержать от 3 до 30 символов.");
                return false;
            }

            // Проверка длины email
            if (email.length < 3 || email.length > 50) {
                alert("Email должен содержать от 3 до 50 символов.");
                return false;
            }

            // Проверка длины пароля
            if (password.length < 3 || password.length > 10) {
                alert("Пароль должен содержать от 3 до 10 символов.");
                return false;
            }

            // Проверка совпадения паролей
            if (password !== confirmPassword) {
                alert("Пароли не совпадают.");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>