<?php
require_once('bd.class.php');
$sql = "SELECT * FROM usuarios ";

$objDb = new bd();
$link = $objDb->conecta_mysql();

$resultado_id = mysqli_query($link,$sql);
if ($resultado_id){
  $dados_usuario = array();
  while ($linha = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){
    $dados_usuario[] = $linha;
  }

  foreach($dados_usuario as $usuario ){
    var_dump($usuario['usuario']);
    echo '<br/>';
  }
}else{
  echo 'Erro na exução da consulta, favor entrar em contato com o administrador do sistema';
}



 ?>
