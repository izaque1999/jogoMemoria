<?php

session_start();

require 'database.php';

if( isset($_SESSION['user_id']) ){

	$records = $conn->prepare('SELECT id,email,password FROM users WHERE id = :id');
	$records->bindParam(':id', $_SESSION['user_id']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$user = NULL;

	if( count($results) > 0){
		$user = $results;
	}

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Secretaria do Meio-Ambiente</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
</head>

<body background="21.jpg"
	style="background-position: down; background-repeat: no-repeat; background-size: cover;">


	<?php if( !empty($user) ): ?>

		<br />Bem-vindo <?= $user['email']; ?> 
		<br /><br />Você logou com sucesso!
		<br /><br />
		Voltar para o <a href="---link ngrok---">chat</a> ou
		<a href="logout.php">sair?</a>
		<br /><br />
		Ou vá para o <a href="jogo_da_memoria/index.html">Jogo da Memória!</a>

	<?php else: ?>

		<h1>Bem-vindo!</h1>
		<img src="19.png" alt="some text" width=27% height=27%>
		<br /><br />CHAT - Inspetores
		<br /><br />Faça <a href="login.php">Login</a> ou
		<a href="register.php">Cadastre-se</a>
		<br /><br />
		<a href="jogo_da_memoria/index.html">Jogo da Memória</a>

	<?php endif; ?>

</body>
</html>