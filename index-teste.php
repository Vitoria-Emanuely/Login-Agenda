<?php


?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
	<title>Document</title>
</head>
<body>

	<div class="social">

		<a href="verifica_usuario.php?acao=sair">sair</a>



		<img src="<?php echo $_SESSION['usuario_link']; ?>" alt="" width="200" height="200">



		<h3>Bem vindo <?=  $_SESSION['usuario_nome']; ?>!</h3>
	</div>

</body>
</html>



