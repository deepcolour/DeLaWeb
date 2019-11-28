<?php
    require "db.php";
?>
<!DOCTYPE HTML>
<html>
	<head>
        <title>Account page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link rel="stylesheet" href="http://bootstraptema.ru/plugins/2015/bootstrap3/bootstrap.min.css" />
        <link rel="stylesheet" href="http://bootstraptema.ru/plugins/font-awesome/4-4-0/font-awesome.min.css" />
        <script src="http://bootstraptema.ru/plugins/jquery/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="http://bootstraptema.ru/plugins/2015/b-v3-3-6/bootstrap.min.js"></script>
        <script src="http://bootstraptema.ru/_sf/3/394.js" type="text/javascript"></script>
        <link rel="stylesheet" href="style.css">
        <script src="index.js"></script>
        <script src="https://www.google.com/recaptcha/api.js"></script>
        <script src="//ulogin.ru/js/ulogin.js"></script>
	</head>
	<body class="is-preload">
        <div class="modal-dialog login animated">
            <div class="modal-content">
                <div class="modal-body"> 
                    <div class="box">
                        <div class="content">                 
                            <div class="form loginBox">
                                <script src="//ulogin.ru/js/ulogin.js"></script>
                                <div class="welcome_container" style="">
                                    <h3>Добро пожаловать,  <?php 
                                        $user_name = $_SESSION['logged_user']-> login != "" ?
                                            $_SESSION['logged_user']-> login  :
                                                $_SESSION['logged_user']["first_name"];
                                        echo $user_name;
                                    ?></h3>
                                    <a href="/logout.php" class="btn btn-default btn-login"id="logoutClick">Выход</a>
                                </div>
                                <hr>
                                <span class="sync_span">Синхронизация с соц. сетью:</span>

                                <div id="uLogin" data-ulogin="display=panel;theme=classic;fields=first_name,identity;providers=vkontakte,odnoklassniki,mailru,facebook;hidden=other;redirect_uri=http%3A%2F%2Fhomepage.ru%2Fsync_from_mainpage.php;mobilebuttons=0;"></div>                                



                                <div name="captcha" class="captcha_box" id="captcha_box">
                                            <div class="g-recaptcha" data-sitekey="6LeR_cMUAAAAAEJmwfnL0bxqmrxll41IA0f8FxAj"></div>
                                    </div>
                                <div id="error_box"></div>
                            </div>
                        </div>
                    </div>   
                </div>
            </div>
        </div>
	</body>
</html>