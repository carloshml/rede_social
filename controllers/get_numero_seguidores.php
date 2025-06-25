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
  $pdo = $db->conecta_database();

  $stmt = $pdo->prepare("
        SELECT COUNT(*) AS numero_seguidores
        FROM usuarios_seguidores
        WHERE id_usuario_seguidor = :id_usuario
    ");
  $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
  $stmt->execute();

  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  echo $result['numero_seguidores'] ?? 0;
} catch (PDOException $e) {
  echo 'Erro ao buscar número de seguidores: ' . htmlspecialchars($e->getMessage());
}
?>