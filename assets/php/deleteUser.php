<?php
// Подключаем класс для работы с JSON CRUD операциями и для работы с выходом из аккаунта
require_once 'handlers/JsonCrudHandler.php';
require_once 'handlers/LogoutHandler.php';
// Запускаем сессию
session_start();

// Создаем экземпляр класса для работы с CRUD операциями и для работы с отчисткой данных при выходе
$crudHandler = new JsonCrudHandler();
$logoutHandler = new LogoutHandler();

// Удаляем пользователя из системы по его логину, хранящемуся в сессии
$crudHandler->delete($_SESSION['login']);

// Очищаем все куки и сессионные данные
$logoutHandler->clearAllData();

// Возвращаем ответ в формате JSON о успешном выполнении операции
echo json_encode(['success' => true]);