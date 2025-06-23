<?php
session_start();
if (!isset($_SESSION['usuario'])) {
	header('Location: index.php?erro=1');
}

require_once('../controllers/bd.class.php');

$objBD = new bd();
$link = $objBD->conecta_mysql();
$id_usuario = $_SESSION['id_usuario'];
$sql = "SELECT * FROM usuarios where id = $id_usuario ";
$result_id = mysqli_query($link, $sql) or die("Impossível executar a query");
if ($result_id) {
	$registro = mysqli_fetch_array($result_id, MYSQLI_ASSOC);
	$foto_usuario = $registro['foto_usuario'];
} else {
	echo 'erro de execução no banco';
}





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

</head>

<body>
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
				<a href="../home.php"><img width="60" src="../imagens/icone.png" /></a>
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
			<form method="post" action="../controllers/usuario-atualizarFotoUsuario.php" id="formCadastrarse"
				enctype="multipart/form-data">
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