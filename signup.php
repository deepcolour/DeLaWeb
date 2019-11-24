<html>
	 <head>
	 	 <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	 </head>
	 <body>
		<form action="" method="POST" id="ajax_form">
			<p>
				<p><strong>Ваш логин</strong></p>
				<input type="text" name="login" value="<?php echo @$data['login']; ?>">
			</p>

			<p>
				<p><strong>Ваш email</strong></p>
				<input type="email" name="email" value="<?php echo @$data['email']; ?>">
			</p>

			<p>
				<p><strong>Ваш пароль</strong></p>
				<input type="password" name="password" value="<?php echo @$data['password']; ?>">
			</p>

			<p>
				<p><strong>Подтверждение пароля</strong></p>
				<input type="password" name="password_2" value="<?php echo @$data['password_2']; ?>">
			</p>

			<p>
				<button type="submit" id="sendData" name="do_signup"> Зарегистрироваться</button>
			</p>
		</form>
		<div id="result_form"></div>
		<script src="valid.js"></script>

	</body>
</html>
