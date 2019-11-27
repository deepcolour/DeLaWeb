function validateEmail($email) {
  var emailReg = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return emailReg.test( $email );
}

function isPasswordsEqual($password1, $password2) {
  return $password1 == $password2;
}

$( document ).ready(function() {
    $("#signupAjaxForm").click(
		function(e){
			e.preventDefault();
			var email = document.getElementsByName('email_signup')[0].value;
			var password1 = document.getElementsByName('password_signup')[0].value;
			var password2 = document.getElementsByName('password_confirmation')[0].value;

		    if(!validateEmail(email))
		    { 	
		      	alert("Некорректно введенная почта");
		      	return false;
		    }
		    else if(!isPasswordsEqual(password1, password2))
		    {
				alert("Пароли не совпадают");
		      	return false;
		    }
		    else 
		    {
				sendAjaxForm('result_form', 'signup_form', 'signup_testform.php');
				return false; 
		    }
		}
	);
});

$( document ).ready(function() {
    $("#loginAjaxForm").click(
		function(e){
			e.preventDefault();
			var email = document.getElementsByName('email')[0].value;
			if(!validateEmail(email))
			{ 	
				alert("Некорректно введенная почта");
				return false;
			}
			else 
			{
				sendAjaxForm('error', 'login_form', 'login.php');
				return false; 
			}
		}
	);
});

function sendAjaxForm(result_form, ajax_form, url) {
    $.ajax({
        url:     url,
        type:     "POST",
        dataType: "html",
        data: $("#"+ajax_form).serialize(), 
        success: function(response) { 
			result = $.parseJSON(response);
			if(result.code == 200 && !result.isRegistrationPage)
			{
				
				window.location.replace("/account.php");
			} else if(result.code == 200 && result.isRegistrationPage)
			{
				showLoginForm();
				alert(result.message);
			}else {
				if(result.message == "Введите капчу")
				{
					$('#captcha_box').css('display', 'block');
					
				}
				alert(result.message);
				//$('#result_form').html(result.message+'<br>');
			}
    	},
    	error: function(response) { 
            $('#result_form').html('Ошибка. Данные не отправлены.');
    	}
 	});
}