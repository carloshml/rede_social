<?php

 session_start();
 if (!isset($_SESSION['usuario'])){
   header('Location: index.php?erro=1');
 }

  require_once('bd.class.php');
  $id_usuario = $_SESSION['id_usuario'];
  $id_tweet  = $_POST['id_tweet'];

  if ($id_tweet  == '' || $id_usuario==''){
    die();
  }
  //estacia o objeto que faz conexão com o bd
  $objDB = new bd();
  $link = $objDB->conecta_mysql();

  $sql = " DELETE FROM tweet WHERE tweet.id_tweet = $id_tweet ";
  mysqli_query($link,$sql);
 ?>
