<html>
<head>
	<title>Registration</title>
</head>
<body>
	<div class='errors'>
		<?=$this->session->flashdata('errors')?>
	</div>
	<form action='/users/register' method='post' id='reg-form'>
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