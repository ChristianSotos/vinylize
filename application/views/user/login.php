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
	<form action='/users/login' method='post' id='login-form'>
		<p>Email: <input type='text' name='email'></p>
		<p>Password: <input type='password' name='password'></p>
		<button type='submit' form='login-form'>Login</button>
	</form>
	<a href='/users/to_reg'>Register</a>
</body>
</html>