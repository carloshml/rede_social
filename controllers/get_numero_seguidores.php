<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: ../index.php?erro=1');
  exit;
}

require_once('../DAO/seguidores.php');

$id_usuario = isset($_REQUEST['id_usuario']) ? (int) $_REQUEST['id_usuario'] : 0;
if ($id_usuario === 0) {
  $id_usuario = $_SESSION['id_usuario'];
}
try {
  $seguidoresService = new SeguidorService();
  $result = $seguidoresService->countFollowers($id_usuario);
  echo $result['numero_seguidores'] ?? 0;
} catch (PDOException $e) {
  echo 'Erro ao buscar número de seguidores: ' . htmlspecialchars($e->getMessage());
}
?>