<?php

session_start();

if( isset($_SESSION['user_id']) ){
	header("Location: /");
}

require 'database.php';

if(!empty($_POST['email']) && !empty($_POST['password'])):
	
	$records = $conn->prepare('SELECT id,email,password FROM users WHERE email = :email');
	$records->bindParam(':email', $_POST['email']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$message = '';

	if(count($results) > 0 && password_verify($_POST['password'], $results['password']) ){

		$_SESSION['user_id'] = $results['id'];
		header("Location: ---link ngrok---");

	} else {
		$message = 'Email e/ou senha não confere(m)';
	}


endif;

?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
</head>

<body background="21.jpg"
	style="background-position: down; background-repeat: no-repeat; background-size: cover;">
<body>

	<?php if(!empty($message)): ?>
		<p><?= $message ?></p>
	<?php endif; ?>

	<h1>Login</h1>
	<span>ou cadastre-se <a href="register.php">aqui</a></span>

	<form action="login.php" method="POST">
		
		<input type="text" placeholder="Digite seu email..." name="email">
		<input type="password" placeholder="... e sua senha" name="password">

		<input type="submit">

	</form>

</body>
</html>