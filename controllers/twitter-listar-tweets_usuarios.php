<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: ../index.php?erro=1');
  exit;
}

require_once('tweet.php');

$tweetService = new Tweet();
$tweets = $tweetService->listarTweets($_SESSION['id_usuario']);

if ($tweets) {
  foreach ($tweets as $registro) {
    echo '<div class="list-group-item">';

    echo '<div class="media">';
    echo ' <div class="text-right">';


    echo '    <div class="btn-group">';

    if ($registro['id_usuario'] == $_SESSION['id_usuario']) {
      echo '      <button id="' . $registro['id_tweet'] . '" class="btn btn-warning btn_apaga_tweet" type="button">';
      echo '        <span class="glyphicon glyphicon-trash"></span>';
      echo '      </button>';
    }
    echo '    </div>'; // .btn-group
    echo '    </div>'; // .btn-group
    echo '  <div class="media-left">';
    echo '      <a class="btn btn-default btn_deixar_seguir" data-id_usuario="' . $registro['id_usuario'] . '" href="views/usuario-view.php?id_usuario=' . $registro['id_usuario'] . '">';
    echo '         <img class="media-object img-circle" src="fotos/' . htmlspecialchars($registro['foto_usuario']) . '" height="60" width="60">';
    echo '      </a>';
    echo '  </div>';
    echo '  <div class="media-body">';
    echo '    <h4 class="media-heading">' . htmlspecialchars($registro['usuario']) . ' <small>' . $registro['data_inclusao'] . '</small></h4>';
    echo '    <p>' . htmlspecialchars($registro['tweet']) . '</p>';


    echo '  </div>';   // .media-body
    echo '</div>';     // .media
    echo '</div>';     // .list-group-item
  }
} else {
  echo '<div class="list-group-item">Nenhum tweet encontrado.</div>';
}
?>