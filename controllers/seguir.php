<?php

 session_start();
 if (!isset($_SESSION['usuario'])){
   header('Location: ../index.php?erro=1');
 }

  require_once('bd.class.php');
  $id_usuario = $_SESSION['id_usuario'];
  $seguir_id_usuario = $_POST['seguir_id_usuario'];

  if ($seguir_id_usuario == '' || $id_usuario==''){
    die();

  }
  //estacia o objeto que faz conexão com o bd
  $objDB = new bd();
  $link = $objDB->conecta_mysql();

  $sql = "INSERT INTO usuarios_seguidores(id_usuario,seguindo_id_usuario) values ($id_usuario,$seguir_id_usuario) ";
  mysqli_query($link,$sql);
 ?>
