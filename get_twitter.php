<?php
session_start();
if (!isset($_SESSION['usuario'])){
  header('Location: index.php?erro=1');
}

require_once('bd.class.php');
$id_usuario = $_SESSION['id_usuario'];

$objDB =  new bd();

$link = $objDB->conecta_mysql();

$sql = "SELECT t.id_tweet,DATE_FORMAT(t.data_inclusao,' %T %d %b %Y ')as data_inclusao , t.tweet, u.usuario FROM tweet as t  JOIN usuarios as u ON (t.id_usuario = u.id)
where id_usuario= 10
or id_usuario in (SELECT seguindo_id_usuario from usuarios_seguidores where id_usuario = 10 )
ORDER BY t.id_tweet DESC ";

$resultado_id = mysqli_query($link,$sql);

if ($resultado_id){
    while($registro = mysqli_fetch_array($resultado_id,MYSQLI_ASSOC)){
      echo  '<a href="#" class="list-group-item">';
        echo '<h4 class="list-group-item-heading">'.$registro['usuario'].'<small>'.$registro['data_inclusao'].'</small></h4>';
        echo '<p class="list-group-item-text">'.$registro['tweet'].'</p>';
      echo '</a>';
    }
}else{
  echo 'erro na consulta';
}


 ?>
