<?php

 session_start();
 if (!isset($_SESSION['usuario'])){
   header('Location: ../index.php?erro=1');
 }

  require_once('bd.class.php');
  // recupera o texto escrito
  $texto_tweet = $_POST['texto_tweet'];
  $id_usuario = $_SESSION['id_usuario'];

  if ($texto_tweet == '' || $id_usuario==''){
    die();

  }
  //estacia o objeto que faz conexão com o bd
  $objDB = new bd();
  $link = $objDB->conecta_mysql();

  $sql = "INSERT INTO tweet(id_usuario,tweet) values ($id_usuario,'$texto_tweet') ";
  mysqli_query($link,$sql);
 ?>
