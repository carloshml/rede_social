<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: index.php?erro=1');
}

$id_usuario = $_SESSION['id_usuario'];
require_once('../DAO/usuario.php');
$usuario = new UsuarioUploader();
$registro = $usuario->fotobyUsuario($id_usuario);
$lugar_foto = $registro['foto_usuario'];

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
  <script language="JavaScript" src="home.js"></script>
  <script language="JavaScript" src="funcoes-sistema.js"></script>
  <link rel="stylesheet" href="../imagens/style.css">
</head>

<body>
  <div id="mensagem-upload" class="text-center"></div>
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
            <a id=" " href="user-update.php" class="btn btn-warning list-group-item-text pull-right btn_apaga_tweet"
              type="button" name="button">
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
          <div class="row">
            <div class="col-md-6">
              <img src="../fotos/<?= $lugar_foto ?>" height="60" width="60">
            </div>
            <div class="col-md-6">
              <h4><?= $_SESSION['usuario']; ?></h4>
            </div>
          </div>
          <hr />
          <div class="row">
            <div class="col-md-6">
              <div>
                <a href="usuario-view.php?id_usuario=<?= $id_usuario ?>">TWEETS</a>
              </div>
              <div id="numero_tweets"> </div>
            </div>
            <div class="col-md-6">
              SEGUIDORES <br />
              <div id="numero_seguidores"> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-body">
          <form id="form_tweet" class="input-group">
            <input id="texto_tweet" type="text" name="texto_tweet" class="form-control"
              placeholder="O que está acontecendo agora?" maxlength="140">
            <span class="input-group-btn">
              <button type="button" id="btn_tweet" class="btn btn-default" name="button">Falar</button>
          </form>
        </div>
      </div>
      <div class="list-group" id="tweets">
      </div>
    </div>
    <div class="col-md-3">
      <div class="panel panel-default">
        <div class="panel-body">
          <h4><a href="procurar_pessoas.php">Procurar Pessoas</a></h4>
        </div>
      </div>
    </div>
  </div>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>

</html>