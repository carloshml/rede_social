<?php
if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
	$uri = 'https://';
} else {
	$uri = 'http://';
}
$uri .= $_SERVER['HTTP_HOST'];

$erro = isset($_GET['erro']) ? $_GET['erro'] : 0;

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

	<script>
		$(document).ready(function () {
			//verificar se os campos de usupario e senha foram devidadmente preenchidos
			// #para o uso do Id
			$('#btn_login').click(function () {
				var campo_vazio = false;

				if ($('#campo_usuario').val() == '') {
					$('#campo_usuario').css({ 'border-color': '#a94442' })
					campo_vazio = true;
				} else {
					$('#campo_usuario').css({ 'border-color': '#CCC' })
				}

				if ($('#campo_senha').val() == '') {
					$('#campo_senha').css({ 'border-color': '#a94442' })
					campo_vazio = true;
				} else {
					$('#campo_senha').css({ 'border-color': '#CCC' })
				}


				if (campo_vazio) return false;

			});
		});
	</script>
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
				<a href="index.php"><img src="imagens/icone.png" /></a>
			</div>

			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="inscrevase.php">Inscrever-se</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>


	<div class="container">

		<!-- Main component for a primary marketing message or call to action -->
		<div class="row">
			<div class="col-md-9">
				<div class="jumbotron">
					<h1>Bem vindo ao Wiremotion</h1>
					<p>Vamor curtir agora?</p>
				</div>
			</div>
			<div class="col-md-3">
				<div class="<?= $erro == 1 ? 'open' : '' ?>">
					<div class="col-md-12">
						<h3>já possui uma conta?</h3>
						<form method="post" action="controllers/validar_acesso.php" id="formLogin">
							<div class="form-group">
								<input type="text" class="form-control" id="campo_usuario" name="usuario"
									placeholder="Usuário" />
							</div>

							<div class="form-group">
								<input type="password" class="form-control red" id="campo_senha" name="senha"
									placeholder="Senha" />
							</div>

							<button type="buttom" class="btn btn-primary" id="btn_login">Entrar</button>
						</form>
						<?php
						if ($erro == 1) {
							echo '<font color="FF0000">usuário ou senha inválido(s)</font>';
						}

						?>

					</div>
				</div>

			</div>


		</div>

	</div>


	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</body>

</html>