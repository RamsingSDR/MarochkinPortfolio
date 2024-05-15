<?php
// Подключаем класс для работы с выходом из аккаунта 
require_once 'handlers/LogoutHandler.php';

// Создаем экземпляр класса для работы с отчисткой данных при выходе
$logoutHandler = new LogoutHandler();

// Очищаем все куки и сессионные данные
$logoutHandler->clearAllData();

// Отправляем ответ о успешном выполнении
echo json_encode(['success' => true]);