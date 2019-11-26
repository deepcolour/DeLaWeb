<?php
	require "db.php";
	$data = $_POST;
	$curl = 'https://www.google.com/recaptcha/api/siteverify';
	$key = '6LeR_cMUAAAAABsNxNS05XZ9BF8da1utfNT4GlHr';
	$query = $curl.'?secret='.$key.'&response='.$_POST['g-recaptcha-response'].'&remoteip='.$_SERVER['REMOTE_ADDR'];
	$cdata = json_decode(file_get_contents($query));

	if (isset($data['do_login']))
	{	
		if ($_SESSION['hit'] < 3 || $cdata->success == true)
		{

		$errors = array();
		$user = R::findOne('users', 'email = ?', array($data['email']));
		if($user)
		{
			if (password_verify($data['password'], $user->password)) 
			{
				$_SESSION['logged_user'] = $user;
				$_SESSION['hit'] = 0;
				
				header('Location: /');
			} else
			{
				$errors[] = 'Неверно введен пароль';
			}
			
				
		}	else
		{
			$errors[] = 'Пользователь с таким логином не существует';
		}

		if ( ! empty($errors))
		{
			echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';
			$_SESSION['hit']++;
		}

		} else
		{
			echo 'Введите капчу';
		}
	}
?>

<form action="login.php" method="POST">
	<p>
		<p><strong>E-mail</strong></p>
		<input type="text" name="email" value="<?php echo @$data['email']; ?>">
	</p>

	<p>
		<p><strong>Пароль</strong></p>
		<input type="password" name="password" value="<?php echo @$data['password']; ?>">
	</p>

	<p>
		<button type="submit" name="do_login">Войти</button>
	</p>
	<?php if ($_SESSION['hit'] >= 3) { ?>
 	<script src="https://www.google.com/recaptcha/api.js"></script>
 	<div class="g-recaptcha" data-sitekey="6LeR_cMUAAAAAEJmwfnL0bxqmrxll41IA0f8FxAj"></div>
 <?php } ?>
</form>
<script src="//ulogin.ru/js/ulogin.js"></script>
<div id="uLogin" data-ulogin="display=panel;theme=classic;fields=first_name,identity;providers=vkontakte,odnoklassniki,mailru,facebook;hidden=other;redirect_uri=http%3A%2F%2Fhomepage.ru%2Fis_registration.php;mobilebuttons=0;"></div>
