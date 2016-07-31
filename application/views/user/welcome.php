<?php
$this->session->sess_destroy();
?>
<html>
<head>
	<title>Welcome</title>
	<link href='http://fonts.googleapis.com/css?family=Arizonia' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="/assets/welcome_style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script>
	$(document).ready(function(){
		$(document).on('submit', '#search-form', function(){
			$.post('/products/new_search');
		})
		$('log-reg-forms').submit(function(){
			$.post('/users/log_reg', $(this).serialize(), function(res){
				$('#center-div').fadeOut(500, 'linear', function(){
					setTimeout(function(){
						$('#center-div').html(res);
						$('#center-div').fadeIn(1000);
					},500);
				})
			})
			return false;
		})
		$(document).on('submit', '.log-reg-forms', function(){
			$.post('/users/log_reg', $(this).serialize(), function(res){
				$('#center-div').fadeOut(500, 'linear', function(){
					setTimeout(function(){
						$('#center-div').html(res);
						$('#center-div').fadeIn(1000);
					},500);
				})
			})
			return false;
		})

		$(document).on('mouseover', '.switch-log-reg', function(){
			$(this).css('cursor', 'pointer');
		})
		$(document).on('click', '.switch-log-reg', function(){
			$('.switch-log-reg-div').toggle();
		})
	})
	</script>
</head>
<body>
<div id='container'>
	<div id='vin-logo'>
		<img src='/assets/pics/vinylize.png'>
	</div>
	<div id='center-div'>
		<div id='login-div' class='switch-log-reg-div'>
			<div class='errors'>
				<?=$this->session->flashdata('errors')?>
			</div>
			<form action='/users/log_reg' method='post' id='login-form' class='log-reg-forms'>
				<input type='hidden' name='action' value='login'>
				<p>Email: <input type='text' name='email'></p>
				<p>Password: <input type='password' name='password'></p>
				<button type='submit' form='login-form'>Login</button>
			</form>
			<span class='switch-log-reg'>Register</span>
		</div>

		<div id='reg-div' class='switch-log-reg-div'>
			<form action='/users/log_reg' method='post' id='reg-form' class='log-reg-forms'>
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