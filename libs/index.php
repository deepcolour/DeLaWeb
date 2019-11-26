<?php
	require "db.php";
	if (isset($_SESSION['logged_user'])) : 
?>
	Авторизован!<br>
	Привет, <?php echo $_SESSION['logged_user']-> login ?>!
	<hr>
	Синхронизация:
	<script src="//ulogin.ru/js/ulogin.js"></script>
	<div id="uLogin" data-ulogin="display=panel;theme=classic;fields=first_name,identity;providers=vkontakte,odnoklassniki,mailru,facebook;hidden=other;redirect_uri=%2Fsync.php;mobilebuttons=0;"></div>
	<hr>
	<a href="/logout.php">Выйти</a>
<?php else : ?>
	Вы не авторизованы<br>
	<a href="/login.php">Авторизоваться</a><br>
	<a href="/signup.php">Регистрация</a>
<?php endif; ?>
