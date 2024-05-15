<!DOCTYPE html>
<html lang="ru">
<head>
    <!-- Указываем кодировку страницы -->
    <meta charset="UTF-8">
    <!-- Устанавливаем мета-тег для адаптивности под различные размеры экрана -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Подключаем CSS файл стилей -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Задаем заголовок страницы -->
    <title>TZ(Madao)Marochkin Andrey</title>
</head>
<body>
    <!-- Основной контейнер содержимого -->
    <div class="content-container">
        <!-- Контейнер панели пользователя -->
        <div id="userpanel-container">
            <div>
                <!-- Заголовок приветствия пользователя -->
                <h1 id="greetings-text">Hello user</h1>
            </div>
            <div>
                <!-- Кнопки для выхода из системы и удаления аккаунта -->
                <button type="submit" class="action-button" id="logout-btn">Log out</button>
                <button type="submit" class="action-button" id="logout-wipe-btn">Log out and wipe all active sessions</button>
                <button type="submit" class="action-button" id="deleteuser-btn">Delete user</button>
            </div>
        </div>
        <!-- Контейнер для форм -->
        <div id="forms-container">
            <!-- Контейнер для формы регистрации -->
            <div class="reg-container">
                <form class="reg-form" method="post" data-action="register.php" id="reg-form">
                    <h2>Registration</h2>
                    <div>
                        <p>Login</p>
                        <label for="login-input-reg" class="error-label-reg"></label>
                        <input type="text" class="text-input" id="login-input-reg" placeholder="Input login" name="login">
                    </div>
                    <div>
                        <p>Name</p>
                        <label for="name-input-reg" class="error-label-reg"></label>
                        <input type="text" class="text-input" id="name-input-reg" placeholder="Input name" name="name">
                    </div>
                    <div>
                        <p>Email</p>
                        <label for="email-input-reg" class="error-label-reg"></label>
                        <input type="email" class="text-input" id="email-input-reg" placeholder="mail_name@mail.com" name="email">
                    </div>
                    <div>
                        <p>Password</p>
                        <label for="pass-input-reg" class="error-label-reg"></label>
                        <input type="password" class="text-input" id="pass-input-reg" name="pass">
                    </div>
                    <div>
                        <p>Confirm Password</p>
                        <label for="passConfirm-input-reg" class="error-label-reg"></label>
                        <input type="password" class="text-input" id="passConfirm-input-reg" name="passConfirm">
                    </div>
                    <button type="submit" class="action-button">Sign up</button>
                </form>
            </div>
            <!-- Контейнер для формы аутентификации -->
            <div class="auth-container">
                <form class="auth-form" method="post" data-action="authenticate.php" id="auth-form">
                    <h2>Authentication</h2>
                    <div>
                        <p>Login</p>
                        <label for="login-input-auth" class="error-label-auth"></label>
                        <input type="text" class="text-input" id="login-input-auth" placeholder="Input login" name="login">
                    </div>
                    <div>
                        <p>Password</p>
                        <label for="pass-input-auth" class="error-label-auth"></label>
                        <input type="password" class="text-input" id="pass-input-auth" name="pass">
                    </div>
                    <button type="submit" class="action-button">Sign in</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Подключаем JavaScript файл -->
    <script src="assets/js/script.js" type="text/javascript"></script>
</body>
</html>
