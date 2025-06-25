<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: ../index.php?erro=1');
}
require_once('../DAO/seguidores.php');

$id_usuario = $_SESSION['id_usuario'];
$seguir_id_usuario = $_POST['seguir_id_usuario'];
$seguidorService = new SeguidorService();

if ($seguidorService->seguir($id_usuario, $seguir_id_usuario)) {
  header('Location: ../views/inscrevase.php?erro_email=1');
  exit;
}
?>