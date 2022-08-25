<?php

session_start();

if( isset($_SESSION['user_id']) ){
	header("Location: /");
}

require 'database.php';

$message = '';

if(!empty($_POST['email']) && !empty($_POST['password'])):
	
	// Enter the new user in the database
	$sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
	$stmt = $conn->prepare($sql);

	$stmt->bindParam(':email', $_POST['email']);
	$stmt->bindValue(':password', password_hash($_POST['password'], PASSWORD_BCRYPT));

	if( $stmt->execute() ):
		$message = 'Cadastrado com sucesso!';
	else:
		$message = 'Desculpe, deve ter ocorrido um problema ao criar sua conta';
	endif;

endif;

?>

<!DOCTYPE html>
<html>
<head>
	<title>Cadastre-se</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
</head>

<body background="21.jpg"
	style="background-position: down; background-repeat: no-repeat; background-size: cover;">
<body>

	<?php if(!empty($message)): ?>
		<p><?= $message ?></p>
	<?php endif; ?>

	<h1>Cadastre-se</h1>
	<span>ou faça login <a href="login.php">aqui</a></span>

	<form action="register.php" method="POST">
		
		<input type="text" placeholder="Digite seu email..." name="email">
		<input type="password" placeholder="... e sua senha" name="password">
		<input type="password" placeholder="Confirme sua senha" name="confirm_password">
		<input type="submit">

	</form>

</body>
</html>