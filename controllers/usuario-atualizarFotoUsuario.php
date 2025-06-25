<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: ../index.php?erro=1');
}
require_once('../DAO/usuario.php');
// Captura os dados do formulário
$usuario_id = (int) $_POST['usuario_id'];
 
$upload = new UsuarioUploader();
if (isset($_FILES['imagem'])) {
  $upload->atualizarFotoUsuario($usuario_id, $_FILES['imagem']);
  echo 'success';
} else {
  echo 'fail';
}
?>