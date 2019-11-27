<?php

require "db.php";
	$data = $_POST;

	if(isset($_POST["email_signup"]) && isset($_POST["password_signup"]) && isset($_POST["login_signup"]) && isset($_POST["password_confirmation"]))
	{
		$_SESSION['hit'] = 0;
		$errors = array();
		if (trim($data['login_signup']) == '')
		{
			$errors[] = 'Введите логин';
		}

		if (trim($data['email_signup']) == '')
		{
			$errors[] = 'Введите email_signup';
		}

		if ($data['password_signup'] == '')
		{
			$errors[] = 'Введите пароль';
		}

		if ($data['password_confirmation'] != $data['password_signup'])
		{
			$errors[] = 'Повторный пароль введен неверно';
		}

		if ( R::count('users', "login = ? ", array($data['login_signup'])) > 0 )
		{
			$errors[] = 'Пользователь с таким логином уже существует';
		}

		if ( R::count('users', "email = ? ", array($data['email_signup'])) > 0 )
		{
			$errors[] = 'Пользователь с таким email уже существует';
		}

		if (empty($errors))
		{
			$user = R::dispense('users');
			$user->login = $data['login_signup'];
			$user->email = $data['email_signup'];
			$user->password = password_hash($data['password_signup'], PASSWORD_DEFAULT);
			R::store($user);
			$result = array(
				'message' => "Вы успешно зарегистрированы.",
				'isRegistrationPage' => true,
				'code' => 200
		    ); 
		} else
		{
			$result = array(
				'message' => array_shift($errors),
				'code' => 500
		    ); 
		}
		echo json_encode($result); 
	}
 ?>