<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: ../index.php?erro=1');
  exit;
}

require_once('bd.class.php');

$id_usuario = isset($_REQUEST['id_usuario']) ? (int) $_REQUEST['id_usuario'] : 0;
if ($id_usuario === 0) {
  $id_usuario = $_SESSION['id_usuario'];
}

try {
  $db = new BD();
  $pdo = $db->conecta_mysql();

  $stmt = $pdo->prepare("SELECT COUNT(*) AS numero_tweets FROM tweet WHERE id_usuario = :id");
  $stmt->bindParam(':id', $id_usuario, PDO::PARAM_INT);
  $stmt->execute();

  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  echo $result['numero_tweets'] ?? 0;
} catch (PDOException $e) {
  echo 'Erro na consulta: ' . htmlspecialchars($e->getMessage());
}
?>