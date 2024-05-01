<?php 
include "app/database/db.php";
// TestOutputInfo();
$isSubmit = false;
$errMsg = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$login = trim($_POST['input_login']);
	$email = trim($_POST['input_email']);
	$pass1 = trim($_POST['input_pass']);
	$pass2 = trim($_POST['input_confirm_pass']);
//проверка валидности введенной информации
	if($login === '' || $email === '' || $pass1 === ''){
		$errMsg = 'Не все поля заполнены!';
	}else if(mb_strlen($login, 'UTF8') < 5){
		$errMsg = 'Логин должен быть более 4-ти символов!';
	}else if($pass1 !== $pass2){
		$errMsg = 'Пароли не совпадают!';
	}else if(mb_strlen($pass1, 'UTF8') < 5){
		$errMsg = 'Пароль должен быть более 4-ти символов!';
	}else if(selectRows('users', ['email'=>$email], 1) || selectRows('users', ['username'=>$login], 1)){
		$errMsg = 'Пользователь с таким логином или email уже зарегистрирован!';
	}else{
// если всё валидно
		$pass = password_hash($pass1, PASSWORD_DEFAULT);
		$post =[
		'username' => $login,
		'email' => $email,
		'password' => $pass
		];
	 	$id = insertRow('users', $post);
	 	$user = selectRows('users', ['id_user'=>$id], 1);
	 	echo 'вывод $user';
	 	print_r($user);
	 	//TestOutputInfo($user);
//по ведомой только богам причине ключ-строку оно не видит
	 	TestOutputInfo($user);
	 	$_SESSION['id'] = $user['id_user'];
	 	$_SESSION['admin'] = $user['admin'];
	 	$_SESSION['login'] = $user['username'];

	 	echo 'вывод $_SESSION';	 	
	 	TestOutputInfo($_SESSION);
	 	$errMsg = "Пользователь <strong>{$login}</strong> успешно зарегистрирован!";
		// $isSubmit = true;
	}

}else{
	$login = '';
	$email = '';
}
