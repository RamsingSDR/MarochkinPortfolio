<?php
// Подключаем класс для работы с CRUD операциями над JSON данными
require_once 'JsonCrudHandler.php';

class AuthenticationHandler
{
    // Объект для работы с CRUD операциями
    private $crudHandler;
    // Массив для хранения ошибок
    public $errors = [];

    // Конструктор класса.
    public function __construct()
    {
        // Инициализируем объект для работы с CRUD операциями
        $this->crudHandler = new JsonCrudHandler();
    }

    // Функция для аутендификации пользователя
    public function authenticateUser($data)
    {
        // Начинаем сессию
        session_start();
        
        // Проверяем валидность данных
        $errors = $this->isValidData($data);

        // Если все данные валидны, продолжаем процесс аутендификации
        if (count(array_keys($errors, '')) === count($errors)){
            // Читаем данные пользователя
            $userData = $this->crudHandler->readBy('login', $data['login']);

            // Генерируем случайный идентификатор сессии
            $sessionId = bin2hex(random_bytes(32));

            // Обновляем данные пользователя, добавляя новый идентификатор сессии
            $updateData['session_id'] = array_merge([$sessionId], $userData['session_id']);

            // Обновляем данные пользователя
            $this->crudHandler->update($userData['login'], $updateData);

            // Устанавливаем куки для сохранения данных пользователя и идентификатора сессии
            setcookie("login", $data['login'], time() + (86400 * 30), "index.php");
            setcookie("name", $userData['name'], time() + (86400 * 30), "index.php");
            setcookie("email", $userData['email'], time() + (86400 * 30), "index.php");
            setcookie("session_id", $sessionId, time() + (86400 * 30), "index.php");

            // Сохраняем данные пользователя в сессии
            $_SESSION['login'] = $data['login'];
            $_SESSION['name'] = $userData['name'];

            return ['success' => true, 'name' => $_SESSION['name']];
        }
        // Возвращаем результат аутентификации с ошибками
        return ['success' => false, 'errors' => $errors];
    }

    // Проверяет валидность данных для аутентификации.
    public function isValidData($data)
    {
        $fields = [
            'login' => trim($data['login']),
            'pass' => trim($data['pass'])
        ];

        // Читаем данные пользователя
        $userData = $this->crudHandler->readBy('login', $fields['login']);

        // Проверяем, есть ли пользователь
        if (!$userData){
            $errors['login'] = '*Неверный логин';
            $errors['pass'] = '*Неверный пароль';
        }else{
            $errors['login'] = '';
            // Проверяем пароль
            $hashedPass = sha1($fields['pass']. $userData['salt']);

            if ($hashedPass!== $userData['pass']) {
                $errors['pass'] = '*Неверный пароль';
            }else{
                $errors['pass'] = '';
            }
        }
        // Возвращаем массив ошибок
        return $errors;
    }
}
