<?php
    require "db.php";
    if(isset($_POST['token'])) {
        $s = file_get_contents('http://ulogin.ru/token.php?token=' . $_POST['token'] . '&host=' . $_SERVER['HTTP_HOST']);
        $user = json_decode($s, true);

        $nomer = $_SESSION['logged_user']-> id;
        $userident = $user['identity'];
       
        R::exec('UPDATE `users` SET identity = null WHERE `identity` = ?', array(
            $userident
        ));
        $userid = R::load('users', $nomer);
        $userid->identity = $userident;
        R::store($userid);
        header('Location: /');
    }
?>

        