<?php
	require "db.php";
	$data = $_POST;
	$curl = 'https://www.google.com/recaptcha/api/siteverify';
	$key = '6LeR_cMUAAAAABsNxNS05XZ9BF8da1utfNT4GlHr';
	$query = $curl.'?secret='.$key.'&response='.$_POST['g-recaptcha-response'].'&remoteip='.$_SERVER['REMOTE_ADDR'];
	$cdata = json_decode(file_get_contents($query));

	if ($_SESSION['hit']  < 3 || $cdata->success == true)
	{
		$errors = array();
		$user = R::findOne('users', 'email = ?', array($_POST['email']));
		if($user)
		{
			if (password_verify($data['password'], $user->password)) 
			{
				$_SESSION['logged_user'] = $user;
				$_SESSION['hit'] = 0;

				$result = array(
					'code' => 200,
					'isRegistrationPage' => false,
					'message' => 'Успешная авторизация'
				); 
			} 
			else
			{
				$_SESSION['hit']++;
				$result = array(
					'code' => 500,
					'isRegistrationPage' => false,
					'message' => 'Неверно введен пароль'
				);
			}
		} 
		else
		{
			$_SESSION['hit']++;
			$result = array(
				'code' => 500,
					'isRegistrationPage' => false,
				'message' => 'Пользователь с таким логином не существует'
			);
		}

	} else
	{
		$result = array(
			'code' => 500,
					'isRegistrationPage' => false,
			'message' => 'Введите капчу'
		);
	}

	echo json_encode($result); 
?>