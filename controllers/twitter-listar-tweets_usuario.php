<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: ../index.php?erro=1');
  exit;
}

require_once('../DAO/tweet.php');

$id_usuario_logado = $_SESSION['id_usuario'];
$id_usuario = isset($_REQUEST['id_usuario']) ? (int) $_REQUEST['id_usuario'] : 0;

if ($id_usuario === 0) {
  header('Location: index.php?erro=1');
  exit;
}

$tweetService = new Tweet();
$tweets = $tweetService->listarTweetsPorUsuario($id_usuario);

if ($tweets) {
  foreach ($tweets as $tweet) {
    echo '<a href="#" class="list-group-item">';
    echo '<p class="list-group-item-text pull-right">';
    echo '<h4>' . htmlspecialchars($tweet['usuario']) .
      ' <small>' . $tweet['data_inclusao'] . '</small></h4>';
    echo '<span class="list-group-item-text">' . htmlspecialchars($tweet['tweet']) . '</span>';

    if ($tweet['id_usuario'] == $id_usuario_logado) {
      echo '<button id="' . $tweet['id_tweet'] . '" class="btn btn-warning list-group-item-text pull-right btn_apaga_tweet" type="button">';
      echo '<span class="glyphicon glyphicon-trash"></span>';
      echo '</button>';
    }

    echo '</p>';
    echo '</a>';
  }
} else {
  echo 'Nenhum tweet encontrado.';
}
?>