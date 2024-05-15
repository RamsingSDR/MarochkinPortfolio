<?php
class LogoutHandler
{
	function clearAllData(){
		// Очищаем все куки, связанные с текущим доменом
		foreach ($_COOKIE as $cookieKey => $value) {
		    // Устанавливаем время истечения куки на 1 час назад, что приводит к их удалению
		    setcookie($cookieKey, '', time() - 3600, 'index.php');
		}
		// Очищаем сессионные данные
		$_SESSION = array();
	}
}