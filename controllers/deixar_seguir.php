<?php

 session_start();
 if (!isset($_SESSION['usuario'])){
   header('Location: ../index.php?erro=1');
 }

  require_once('bd.class.php');
  $id_usuario = $_SESSION['id_usuario'];
  $deixar_seguir_id_usuario = $_POST['deixar_seguir_id_usuario'];

  if ($deixar_seguir_id_usuario == '' || $id_usuario==''){
    die();
  }
  //estacia o objeto que faz conexão com o bd
  $objDB = new bd();
  $link = $objDB->conecta_mysql();

  $sql = " DELETE FROM usuarios_seguidores WHERE id_usuario= $id_usuario AND seguindo_id_usuario = $deixar_seguir_id_usuario ";
  mysqli_query($link,$sql);
 ?>
