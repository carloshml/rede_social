<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: ../index.php?erro=1');
  exit;
}

require_once('bd.class.php');

$nome_pessoa = $_POST['nome_pessoa'] ?? '';
$id_usuario = $_SESSION['id_usuario'];

try {
  $db = new BD();
  $pdo = $db->conecta_mysql();

  $sql = "
        SELECT u.id, u.usuario, u.email, us.id_usuario_seguidor
        FROM usuarios u
        LEFT JOIN usuarios_seguidores us 
            ON us.id_usuario = :id_usuario 
           AND u.id = us.id_usuario_seguidor
        WHERE u.usuario LIKE :nome_pessoa 
          AND u.id <> :id_usuario
    ";

  $stmt = $pdo->prepare($sql);
  $search_term = "%{$nome_pessoa}%";
  $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
  $stmt->bindParam(':nome_pessoa', $search_term, PDO::PARAM_STR);
  $stmt->execute();

  $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

  foreach ($usuarios as $registro) {
    echo '<a href="#" class="list-group-item">';
    echo '<strong>' . htmlspecialchars($registro['usuario']) . '</strong> <small> - ' . htmlspecialchars($registro['email']) . '</small>';
    echo '<p class="list-group-item-text pull-right">';

    $esta_seguindo = !empty($registro['id_usuario_seguidor']);
    $exibir_seguir = $esta_seguindo ? 'none' : 'block';
    $exibir_deixar = $esta_seguindo ? 'block' : 'none';

    echo '<button id="btn_seguir_' . $registro['id'] . '" type="button" class="btn btn-default btn_seguir" style="display:' . $exibir_seguir . ';" data-id_usuario="' . $registro['id'] . '">';
    echo ' <i class="glyphicon glyphicon-heart-empty"></i></button>';

    echo '<button id="btn_deixar_seguir_' . $registro['id'] . '" type="button" class="btn btn-default btn_deixar_seguir" style="display:' . $exibir_deixar . ';" data-id_usuario="' . $registro['id'] . '">';
    echo ' <i class="glyphicon glyphicon-remove"></i></button>';

    echo '</p><div class="clearfix"></div>';
    echo '</a>';
  }
} catch (PDOException $e) {
  echo 'Erro na consulta: ' . htmlspecialchars($e->getMessage());
}
?>