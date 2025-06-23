<?php
session_start();
require_once('bd.class.php');

$usuario = $_POST['usuario'] ?? '';
$senha = $_POST['senha'] ?? '';

if (empty($usuario) || empty($senha)) {
  header('Location: ../index.php?erro=1');
  exit;
}

try {
  $db = new BD();
  $pdo = $db->conecta_mysql();

  $stmt = $pdo->prepare("SELECT id, usuario, email, senha FROM usuarios WHERE usuario = :usuario");
  $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
  $stmt->execute();

  $dados_usuario = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($dados_usuario && password_verify($senha, $dados_usuario['senha'])) {
    $_SESSION['id_usuario'] = $dados_usuario['id'];
    $_SESSION['usuario'] = $dados_usuario['usuario'];
    $_SESSION['email'] = $dados_usuario['email'];
    header('Location: ../home.php');
    exit;
  } else {
    header('Location: ../index.php?erro=1');
    exit;
  }
} catch (PDOException $e) {
  echo 'Erro na execução da consulta: ' . htmlspecialchars($e->getMessage());
}