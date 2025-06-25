<?php
session_start();
if (!isset($_SESSION['usuario'])) {
	header('Location: index.php?erro=1');
}

require_once('../DAO/usuario.php');
$usuario = new UsuarioUploader();
$registro = $usuario->fotoUsuario();
$id_usuario = $registro['id'];
$foto_usuario = $registro['foto_usuario'];
?>
<!DOCTYPE HTML>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">

	<title>Wiremotion</title>

	<!-- jquery - link cdn -->
	<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
	<script>
		$(document).ready(function () {
			$('#formCadastrarse').on('submit', function (e) {
				e.preventDefault(); // Block default form submission

				var formData = new FormData(this);
				console.log('formData:', formData);
				$('#mensagem-upload').html('Enviando imagem...');

				$.ajax({
					url: '../controllers/usuario-atualizarFotoUsuario.php',
					type: 'POST',
					data: formData,
					contentType: false,
					processData: false,
					success: function (response) {
						$('#mensagem-upload').html('<span class="text-success">Foto atualizada com sucesso!</span>');
						setTimeout(() => {
							location.reload();
						}, 1500);
					},
					error: function () {
						$('#mensagem-upload').html('<span class="text-danger">Erro ao atualizar foto.</span>');
					}
				});
			});
		});
	</script>


	<!-- bootstrap - link cdn -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" href="../imagens/style.css">
</head>

<body>
	<div id="mensagem-upload" class="text-center" style="margin-top:10px;"></div>
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
				<a href="../home.php"><img class="img-logo" src="../imagens/icone.png" /></a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="../controllers/app-sair.php">Sair</a></li>
					<li>
						<a id=" " href="../views/user-update.php"
							class="btn btn-warning list-group-item-text pull-right btn_apaga_tweet" type="button"
							name="button">
							<span class="glyphicon glyphicon-cog"> </span>
						</a>

					</li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>
	<div class="container">
		<div class="col-md-12">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div>
					<img src="../fotos/<?= $foto_usuario ?>" height="100" width="100">
				</div>
				<h3> Oi, <?= $_SESSION['usuario']; ?> </h3>
			</div>
			<div class="col-md-4"></div>
		</div>
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<form id="formCadastrarse" enctype="multipart/form-data">
				<input type="hidden" class="form-control" id="usuario_id" name="usuario_id" value="<?= $id_usuario ?>"
					required="required">
				nova imagem:
				<div class="form-group">
					<input type="file" class="form-control" id="imagem" name="imagem" required="required" />
				</div>
				<button type="submit" class="btn btn-primary form-control">Atualzar</button>
			</form>
		</div>
		<div class="col-md-4"></div>



	</div>

</body>

</html>