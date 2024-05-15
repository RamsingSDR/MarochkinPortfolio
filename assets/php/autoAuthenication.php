<?php
// Подключаем класс для работы с JSON данными CRUD операциями
require_once 'handlers/JsonCrudHandler.php';

// Запускаем сессию
session_start();

// Создаем экземпляр класса для работы с CRUD операциями
$crudHandler = new JsonCrudHandler();

// Проверяем наличие cookies для логина и session_id
if(isset($_COOKIE['login']) && isset($_COOKIE['session_id'])){
    // Читаем данные пользователя по логину
    $userData = $crudHandler->readBy('login', $_COOKIE['login']);

    // Проходимся по всем session_id пользователя
    foreach ($userData['session_id'] as $sessionId) {
        // Сравниваем текущий session_id cookie с теми, что хранятся в базе данных
        if($_COOKIE['session_id'] === $sessionId){
            // Если совпадение найдено, сохраняем данные в сессию
            $_SESSION['login'] = $_COOKIE['login'];
            $_SESSION['name'] = $_COOKIE['name'];

            // Отправляем JSON с успехом
            echo json_encode(['success' => true, 'name' => $_SESSION['name']]);

            // Прерываем цикл, так как пользователь успешно аутентифицирован
            break;
        }
        else{
            // Если session_id не совпадает, отправляем JSON с ошибкой
            echo json_encode(['success' => false]);
        }
    }
}else{
    // Если cookies отсутствуют, отправляем JSON с ошибкой
    echo json_encode(['success' => false]);
}