<?php
require_once('bd.class.php');
require_once('usuario.php');
// Captura os dados do formulário
$usuario_id = (int) $_POST['usuario_id'];
$email = trim($_POST['email']);
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // senha não está sendo usada aqui, mas mantida por coerência

$upload = new UsuarioUploader();

if ($upload->verificarEmailExiste($email)) {
  header('Location: ../views/inscrevase.php?erro_email=1');
  exit;
}

if (isset($_FILES['imagem'])) {
  $upload->atualizarFotoUsuario($usuario_id, $_FILES['imagem']);
} else {
  die('Nenhum arquivo enviado.');
}
?>