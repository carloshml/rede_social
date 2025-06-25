<?php
require_once('../DAO/usuario.php');

$usuario = $_POST['usuario'];
$email = $_POST['email'];
$senha = md5($_POST['senha']);
$imagem = $_FILES['imagem'];

$uploader = new UsuarioUploader();
$usuarios_existentes = $uploader->existeUsuarioOuEmail($usuario, $email);

$usuario_existe = false;
$email_existe = false;
foreach ($usuarios_existentes as $dados) {
  if ($dados['usuario'] === $usuario)
    $usuario_existe = true;
  if ($dados['email'] === $email)
    $email_existe = true;
}

if ($usuario_existe || $email_existe) {
  $params = [];
  if ($usuario_existe)
    $params[] = "erro_usuario=1";
  if ($email_existe)
    $params[] = "erro_email=1";
  header("Location: ../views/inscrevase.php?" . implode("&", $params));
  exit;
}


$upload_folder = '../fotos/';
$nome_final = basename($imagem['name']);
if ($imagem['error'] !== 0 || !move_uploaded_file($imagem['tmp_name'], $upload_folder . $nome_final)) {
  die('Erro no upload da imagem.');
}


if ($uploader->cadastrarUsuario($usuario, $email, $senha, $nome_final)) {
  header('Location: ../index.php');
  exit;
} else {
  echo 'Erro ao cadastrar o usuário.';
}

?>