<?php

require "db.php";
	$data = $_POST;

	if(isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["login"]) && isset($_POST["password_2"]))
	{
		$errors = array();
		if (trim($data['login']) == '')
		{
			$errors[] = 'Введите логин';
		}

		if (trim($data['email']) == '')
		{
			$errors[] = 'Введите email';
		}

		if ($data['password'] == '')
		{
			$errors[] = 'Введите пароль';
		}

		if ($data['password_2'] != $data['password'])
		{
			$errors[] = 'Повторный пароль введен неверно';
		}

		if ( R::count('users', "login = ? ", array($data['login'])) > 0 )
		{
			$errors[] = 'Пользователь с таким логином уже существует';
		}

		if ( R::count('users', "email = ? ", array($data['email'])) > 0 )
		{
			$errors[] = 'Пользователь с таким email уже существует';
		}

		if (empty($errors))
		{
			$user = R::dispense('users');
			$user->login = $data['login'];
			$user->email = $data['email'];
			$user->password = password_hash($data['password'], PASSWORD_DEFAULT);
			R::store($user);
			$result = array(
				'message' => "Вы успешно зарегистрированы. Можете перейти на <a href='/'>главную</a> страницу",
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