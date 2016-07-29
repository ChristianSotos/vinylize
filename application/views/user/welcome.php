<?php
$this->session->sess_destroy();
?>
<html>
<head>
	<title>Welcome</title>
	<link rel="stylesheet" type="text/css" href="/assets/welcome_style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script>
	$(document).ready(function(){
		$('form').submit(function(){
			$.post('/users/log_reg', $(this).serialize(), function(res){
				$('#center-div').html(res);
			})
			return false;
		})
		$('.switch-log-reg').hover(function(){
			$(this).css('cursor', 'pointer');
		})
		$('.switch-log-reg').click(function(){
			$('.switch-log-reg-div').toggle();
		});
	})
	</script>
</head>
<body>
<div id='container'>
	<div id='center-div'>
		<div id='login-div' class='switch-log-reg-div'>
			<div class='errors'>
				<?=$this->session->flashdata('errors')?>
			</div>
			<form action='/users/log_reg' method='post' id='login-form'>
				<input type='hidden' name='action' value='login'>
				<p>Email: <input type='text' name='email'></p>
				<p>Password: <input type='password' name='password'></p>
				<button type='submit' form='login-form'>Login</button>
			</form>
			<span class='switch-log-reg'>Register</span>
		</div>

		<div id='reg-div' class='switch-log-reg-div'>
			<form action='/users/log_reg' method='post' id='reg-form'>
				<input type='hidden' name='action' value='register'>
				<p>First Name: <input type='text' name='first_name'></p>
				<p>Last Name: <input type='text' name='last_name'></p>
				<p>Email: <input type='text' name='email'></p>
				<p>Password: <input type='password' name='password'></p>
				<p>Confirm: <input type='password' name='confirm_password'></p>
				<button type='submit' form='reg-form'>Register</button>
			</form>
			<span class='switch-log-reg'>Login</span>
		</div>
	</div>
</div>
</body>
</html>