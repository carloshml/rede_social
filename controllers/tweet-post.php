<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: ../index.php?erro=1');
  exit;
}

require_once('../config/bd.class.php');

$texto_tweet = trim($_POST['texto_tweet'] ?? '');
$id_usuario = $_SESSION['id_usuario'] ?? null;

if (empty($texto_tweet) || empty($id_usuario)) {
  http_response_code(400);
  die('Dados inválidos');
}

try {
  $db = new BD();
  $pdo = $db->conecta_database();
  $stmt = $pdo->prepare("INSERT INTO tweet (id_usuario, tweet) VALUES (:id_usuario, :tweet)");
  $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
  $stmt->bindParam(':tweet', $texto_tweet, PDO::PARAM_STR);
  $stmt->execute();
} catch (PDOException $e) {
  http_response_code(500);
  echo 'Erro ao inserir tweet: ' . htmlspecialchars($e->getMessage());
}
?>