<?php
$erro_usuario = isset($_GET['erro_usuario']) ? $_GET['erro_usuario'] : 0;
$erro_email = isset($_GET['erro_email']) ? $_GET['erro_email'] : 0;

?>

<!DOCTYPE HTML>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">

	<title>Wiremotion</title>

	<!-- jquery - link cdn -->
	<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

	<!-- bootstrap - link cdn -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" href="../imagens/style.css">
</head>

<body>

	<!-- Static navbar -->
	<nav class="navbar navbar-default navbar-static-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
					aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="../index.php"><img class="img-logo" src="../imagens/icone.png" /></a>
			</div>

			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="../index.php">Voltar para Home</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>


	<div class="container">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<h3>Inscreva-se já.</h3>
			<form method="post" action="../controllers/usuario-create.php" id="formCadastrarse"
				enctype="multipart/form-data">
				<div class="form-group">
					<input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuário"
						required="required">
					<?php
					if ($erro_usuario) {// 1 = true   0=false
						echo '<font style="color:#FF0000"> usuario já existe</font>';
					}
					?>
				</div>
				<div class="form-group">
					<input type="email" class="form-control" id="email" name="email" placeholder="Email"
						required="required">
					<div class="invalid-feedback">Por favor, insira um e-mail válido.</div>
					<?php
					if ($erro_email) {
						echo '<font style="color:#FF0000"> e-mail já existe</font>';
					}
					?>
				</div>
				<div class="form-group">
					<input type="password" class="form-control" id="senha" name="senha" placeholder="Senha"
						required="required">
				</div>
				<div class="form-group">
					<input type="file" class="form-control" id="imagem" name="imagem" required="required" />
				</div>
				<button type="submit" class="btn btn-primary form-control">Inscreva-se</button>
			</form>
		</div>
		<div class="col-md-4"></div>

		<div class="clearfix"></div>
		<br />
		<div class="col-md-4"></div>
		<div class="col-md-4"></div>
		<div class="col-md-4"></div>

	</div>


	</div>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</body>

</html>