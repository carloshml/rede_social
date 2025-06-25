<?php
session_start();
if (!isset($_SESSION['usuario'])) {
	header('Location: index.php?erro=1');
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


	<link rel="stylesheet" href="../imagens/style.css">
	<script language="JavaScript" src="funcoes-sistema.js"></script>
	<script language="JavaScript" src="user-followers.js"></script>

</head>

<body>
	<div id="mensagem-upload" class="text-center"></div>
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
				<a href="home.php"><img class="img-logo" src="../imagens/icone.png" /></a>
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
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-body">
					<h4><?= $_SESSION['usuario']; ?></h4>
					<hr />
					<div class="col-md-6">
						TWEETS <br />
						<div class="" id="numero_tweets">

						</div>

					</div>
					<div class="col-md-6">
						SEGUIDORES <br />
						<div class="" id="numero_seguidores">

						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-body" id="followers">

				</div>
			</div>
			<div class="list-group" id="id_pessoas">

			</div>
		</div>

	</div>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</body>

</html>