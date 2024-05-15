<?php 
// Подключаем класс для обработки аутентификации
require_once 'handlers/AuthenticationHandler.php';

// Устанавливаем тип содержимого ответа в JSON
header('Content-Type: application/json');

// Создаем экземпляр класса AuthenticationHandler для работы с аутентификацией
$authenicationHandler = new AuthenticationHandler();

// Проверяем, является ли запрос AJAX
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])!= 'xmlhttprequest') {
    die('AJAX request required');
}

// Проверяем, был ли запрос методом POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
         // Получаем данные из тела запроса
         $data = json_decode(file_get_contents('php://input'), true);
     
         // Аутентифицируем пользователя с помощью полученных данных
         $response = $authenicationHandler->authenticateUser($data);
     
         // Проверяем, была ли аутентификация успешной
         if ($response['success']) {
             // Отправляем ответ о успешной аутентификации
             echo json_encode(['success' => true, 'name' => $response['name']]);
         } else {
             // Отправляем ответ с ошибками аутентификации
             echo json_encode(['success' => false, 'errors' => $response['errors']]);
         }
}