<?php
// Подключаем класс для работы с JSON CRUD операциями и для работы с выходом из аккаунта
require_once 'handlers/JsonCrudHandler.php';
require_once 'handlers/LogoutHandler.php';

// Запускаем сессию
session_start();

// Создаем экземпляр класса для работы с CRUD операциями и для работы с отчисткой данных при выходе
$crudHandler = new JsonCrudHandler();
$logoutHandler = new LogoutHandler();

// Читаем данные пользователя по логину из сессии
$userData = $crudHandler->readBy('login', $_SESSION['login']);

// Обновляем данные пользователя в базе данных, заменя список сессий на пустой
$crudHandler->update($_COOKIE['login'], ['session_id' => []]);

// Очищаем все куки и сессионные данные
$logoutHandler->clearAllData();

// Возвращаем результат выполнения в формате JSON
echo json_encode(['success' => true]);