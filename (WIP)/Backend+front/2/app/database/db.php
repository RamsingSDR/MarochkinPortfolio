<?php

require 'connect.php';

session_start();
//выборка из выбранной таблицы с выбранными условиями и лимитом
function selectRows($table, $params = [], $limitNum){
	global $pdo;
	$sql = "SELECT * FROM `{$table}`";

	if(!empty($params)){
		$i = 0;
		foreach ($params as $key => $value){
			if(!is_numeric($value)){
				$value = "'{$value}'";
			}
			if($i === 0){
				$sql = $sql . " WHERE $key = $value";
			}else{
				$sql = $sql . " AND $key = $value";
			}
			$i++;
		 } 
	}
	if($limitNum !== 0)
	{
		$sql = $sql . " LIMIT $limitNum";
	}

	$query = prepareQuery($sql);

	return $query->fetchAll();
}
//вставка в выбранную таблицы с выбранными параметрами
///////////////НУЖНО ПЕРЕДЕЛАТЬ В БОЛЕЕ ЧИТАЕМЫЙ ФОРМАТ/////////////////////////
function insertRow($table, $params = []){
	global $pdo;

	$sql = "INSERT INTO `{$table}` (";
	$sqlMid =") VALUES (";
	$i = 0;
	foreach($params as $key => $value){
		if(!is_numeric($value)){
			$value = "'{$value}'";
		}
		$sql = $sql . "`{$key}`, ";
		$sqlMid = $sqlMid . "{$value},";
		$i++;
	}
	//обрезаем "хвосты" у частей запроса
	$sql = substr($sql, 0, -2);
	$sqlMid = substr($sqlMid, 0, -1);
	//обьединяем части в полноценный запрос и добавляем нужный хвост
	$sql = $sql . $sqlMid . ')';

	$query = prepareQuery($sql);

	return $pdo->lastInsertId();
}
//обновление существующей строки
function updateRow($table, $id, $params = []){
	global $pdo;
	$sql = "UPDATE `{$table}` SET ";

	if(!empty($params)){
		$i = 0;
		foreach ($params as $key => $value){
			if(!is_numeric($value)){
				$value = "'{$value}'";
			}
			$sql = $sql . "{$key} = {$value}, ";
		 } 
		$sql = substr($sql, 0, -2);
	}
	$sql = $sql . " WHERE id_user = {$id}";

	$query = prepareQuery($sql);
}
//удаление строки из таблицы
function deleteRow($table, $id){
	global $pdo;

	$sql = "DELETE FROM `{$table}` WHERE id_user = $id";

	echo $sql;
	$query = prepareQuery($sql);	
}
//подготовка запроса
function prepareQuery($sql){
	global $pdo;
	$query = $pdo->prepare($sql);
	$query->execute();

	dbCheckError($query);

	return $query;
}
// проверка выполнения запроса к ДБ
function dbCheckError($query){
	$errInfo = $query->errorInfo();
	if($errInfo[0] !== PDO::ERR_NONE){
		echo $errInfo[2];
		exit();
	}
}



////////////////testing////////////////////
// $paramSelect =[
// 	'admin' => 0,
// ];
// $paramInsert =[
// 	'admin' => 0,
// 	'username' => 'phpUser2',
// 	'email' => 'phpmail2@mail.com',
// 	'password' => 'passPHP2'
// ];
// $paramUpdate =[
// 	'username' => 'changedPhpUser2',
// 	'password' => 'changedPassPHP2'
// ];
// $paramDelete =[
// 	'username' => 'user7'
// ];
//красивый вывод для проверки
function TestOutputInfo($str){
	echo "<pre>";
	print_r($str);
	echo "<pre>";
}
// // $result = deleteRow('users', 1);
// // TestOutputInfo($result);