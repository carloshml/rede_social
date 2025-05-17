<?php
session_start();
if (!isset($_SESSION['usuario'])){
  header('Location: index.php?erro=1');
}
require_once('bd.class.php');
$id_usuario = $_SESSION['id_usuario'];
$objDB =  new bd();

$link = $objDB->conecta_mysql();

$sql = "SELECT * FROM usuarios where id = $id_usuario " ;
$result_id = mysqli_query($link,$sql) or die("Impossível executar a query");

if ($result_id){
    while($registro = mysqli_fetch_array($result_id,MYSQLI_ASSOC)){
						 $lugar_foto = $registro['foto_usuario'];
					 }
}



?>
