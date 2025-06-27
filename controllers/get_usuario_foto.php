<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: ../index.php?erro=1');
  exit;
}

require_once('../config/bd.class.php');

$id_usuario = $_SESSION['id_usuario'];

try {
  $db = new BD();
  $pdo = $db->conecta_database();

  $sql = "SELECT foto_usuario FROM usuarios WHERE id = :id_usuario";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
  $stmt->execute();

  $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($usuario) {
    $lugar_foto = $usuario['foto_usuario'];
  } else {
    throw new RuntimeException('Usuário não encontrado.');
  }
} catch (PDOException $e) {
  echo 'Erro ao buscar foto do usuário: ' . htmlspecialchars($e->getMessage());
}
?>