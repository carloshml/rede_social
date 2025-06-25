<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: ../index.php?erro=1');
  exit;
}

require_once('bd.class.php');

$id_usuario = $_SESSION['id_usuario'];
$id_tweet = $_POST['id_tweet'] ?? null;

if (empty($id_tweet) || empty($id_usuario)) {
  http_response_code(400);
  die('Requisição inválida.');
}

try {
  $db = new BD();
  $pdo = $db->conecta_database();

  $sql = "DELETE FROM tweet WHERE id_tweet = :id_tweet AND id_usuario = :id_usuario";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':id_tweet', $id_tweet, PDO::PARAM_INT);
  $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);

  if ($stmt->execute()) {
    echo 'Tweet apagado com sucesso.';
  } else {
    http_response_code(500);
    echo 'Erro ao apagar tweet.';
  }
} catch (PDOException $e) {
  http_response_code(500);
  echo 'Erro no banco de dados: ' . htmlspecialchars($e->getMessage());
}
?>