<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: ../index.php?erro=1');
  exit;
}

require_once('../DAO/seguidores.php');

$id_usuario = isset($_REQUEST['id_usuario']) ? (int) $_REQUEST['id_usuario'] : $_SESSION['id_usuario'];

try {
  $seguidoresService = new SeguidorService();
  $seguidores = $seguidoresService->getFollowers($id_usuario);

  if ($seguidores) {
    foreach ($seguidores as $seguidor) {
      echo '<div class="media list-group-item" style="margin-bottom: 10px;">';
      echo '  <div class="media-left">';
      echo '    <a href="usuario-view.php?id_usuario=' . htmlspecialchars($seguidor['id_follower']) . '">';
      echo '      <img class="media-object img-circle" src="../fotos/' . htmlspecialchars($seguidor['foto_usuario']) . '" width="60" height="60">';
      echo '    </a>';
      echo '  </div>';
      echo '  <div class="media-body">';
      echo '    <h4 class="media-heading">' . htmlspecialchars($seguidor['usuario']) . '</h4>';
      echo '    <button id="btn_deixar_seguir_' . $seguidor['id_follower'] . '" type="button" class="btn btn-default btn_deixar_seguir"  ';
      echo '        data-id_usuario="' . $seguidor['id_follower'] . '"> <i class="glyphicon glyphicon-remove"></i>';
      echo '    </button>';
      echo '  </div>';
      echo '</div>';
    }
  } else {
    echo '<div class="alert alert-info">Este usuário ainda não tem seguidores.</div>';
  }
} catch (PDOException $e) {
  echo '<div class="alert alert-danger">Erro ao buscar seguidores: ' . htmlspecialchars($e->getMessage()) . '</div>';
}
?>