<?php 
// Подключаем класс обработчика регистрации
require_once 'handlers/RegistrationHandler.php';

// Устанавливаем тип содержимого ответа в JSON
header('Content-Type: application/json;charset=UTF-8');

// Создаем экземпляр класса обработчика регистрации
$registrationHandler = new RegistrationHandler();

// Проверяем, является ли запрос AJAX
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])!= 'xmlhttprequest') {
    die('AJAX request required');
}

// Проверяем, был ли запрос выполнен методом POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из тела запроса и декодируем их из JSON в массив
    $data = json_decode(file_get_contents('php://input'), true);

    // Вызываем метод регистрации пользователя с полученными данными
    $response = $registrationHandler->registerUser($data);

    // Проверяем, был ли процесс регистрации успешным
    if ($response['success']) {
        // Отправляем ответ о успешной регистрации
        echo json_encode(['success' => true]);
    } else {
        // Отправляем ответ с ошибками, если регистрация не удалась
        echo json_encode(['success' => false, 'errors' => $response['errors']]);
    }
}