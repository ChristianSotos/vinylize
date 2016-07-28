<?php
$this->session->sess_destroy();
?>
<html>
<head>
	<title>Login</title>
</head>
<body>
	<div class='errors'>
		<?=$this->session->flashdata('errors')?>
	</div>
	<form action='/users/log_reg' method='post' id='login-form'>
		<input type='hidden' name='action' value='login'>
		<p>Email: <input type='text' name='email'></p>
		<p>Password: <input type='password' name='password'></p>
		<button type='submit' form='login-form'>Login</button>
	</form>
	<a href='/users/to_reg'>Register</a>
	<form action='/users/log_reg' method='post' id='reg-form'>
		<input type='hidden' name='action' value='register'>
		<p>First Name: <input type='text' name='first_name'></p>
		<p>Last Name: <input type='text' name='last_name'></p>
		<p>Email: <input type='text' name='email'></p>
		<p>Password: <input type='password' name='password'></p>
		<p>Confirm: <input type='password' name='confirm_password'></p>
		<button type='submit' form='reg-form'>Register</button>
	</form>
	<a href='/users'>Login</a>
</body>
</html>