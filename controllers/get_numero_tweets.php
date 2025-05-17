<?php
session_start();
if (!isset($_SESSION['usuario'])){
  header('Location: ../index.php?erro=1');
}

require_once('bd.class.php');
$id_usuario = $_SESSION['id_usuario'];

$objDB =  new bd();

$link = $objDB->conecta_mysql();


  $sql = "SELECT COUNT(*) as numero_tweets from tweet where id_usuario = $id_usuario";

  if ($resultado_id = mysqli_query($link,$sql)){
        $registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
        echo $registro['numero_tweets'];

      } else {
        echo 'erro de execução no banco';
      }
?>
