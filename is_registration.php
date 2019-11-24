<?php
	require "db.php";
	if(isset($_POST['token'])) {
		$s = file_get_contents('http://ulogin.ru/token.php?token=' . $_POST['token'] . '&host=' . $_SERVER['HTTP_HOST']);
		$user = json_decode($s, true);
	
		if (R::count('users', "identity = ?", array($user['identity'])) > 0 ) {
			echo 'Привет, ' . $user['first_name']; 
		}else {
			$userq = R::dispense('users');
			$userq->identity = $user['identity'];
			R::store($userq);
			echo 'Привет, ' . $user['first_name'];
		}		
	}	
?>

<hr>
<a href="/logout.php">Выйти</a>