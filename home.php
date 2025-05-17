<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: index.php?erro=1');
}
//atribuição do id do usuario da sessão
$id_usuario = $_SESSION['id_usuario'];
// conexão com o banco
require_once('controllers/bd.class.php');
$objBD = new bd();
$link = $objBD->conecta_mysql();
// recuperar quantidade de tweets
$sql = "SELECT COUNT(*) as qtde_tweets from tweet WHERE id_usuario = $id_usuario ";
$qtde_tweets = 0;
if ($resultado_id = mysqli_query($link, $sql)) {
  $registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
  $qtde_tweets = $registro['qtde_tweets'];
} else {
  echo 'erro de execução no banco';
}

// quantidade de seguidores

$sql = "SELECT COUNT(*) as qtde_seguidores from usuarios_seguidores WHERE seguindo_id_usuario = $id_usuario";
$qtde_seguidores = 0;
if ($resultado_id = mysqli_query($link, $sql)) {
  $registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
  $qtde_seguidores = $registro['qtde_seguidores'];
} else {
  echo 'erro de execução no banco';
}

$sql = "SELECT * FROM usuarios where id = $id_usuario ";
$result_id = mysqli_query($link, $sql) or die("Impossível executar a query");
if ($result_id) {
  $registro = mysqli_fetch_array($result_id, MYSQLI_ASSOC);
  $lugar_foto = $registro['foto_usuario'];
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
  <script language="JavaScript" src="carregamentos.js"></script>
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
        <a href="home.php"><img src="imagens/icone.png" /></a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="sair.php">Sair</a></li>
          <li>
            <a id=" "  href="views/user-update.php" class="btn btn-warning list-group-item-text pull-right btn_apaga_tweet" type="button"
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
          <div class="row">
            <div class="col-md-6">
              <img src="fotos/<?= $lugar_foto ?>" height="60" width="60">
            </div>
            <div class="col-md-6">
              <h4><?= $_SESSION['usuario']; ?></h4>
            </div>
          </div>
          <hr />
          <div class="row">
            <div class="col-md-6">
              <div>
                <a href="tweet_usuario.php">TWEETS</a>
              </div>
              <div id="numero_tweets"> </div>
            </div>
            <div class="col-md-6">
              SEGUIDORES <br /> <?= $qtde_seguidores ?>
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
          <h4><a href="views/procurar_pessoas.php">Procurar Pessoas</a></h4>
        </div>
      </div>
    </div>
  </div>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>

</html>