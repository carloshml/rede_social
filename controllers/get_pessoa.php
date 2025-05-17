<?php
session_start();
if (!isset($_SESSION['usuario'])){
  header('Location: ../index.php?erro=1');
}

require_once('bd.class.php');
$nome_pessoa= $_POST['nome_pessoa'];
$id_usuario = $_SESSION['id_usuario'];

$objDB =  new bd();

$link = $objDB->conecta_mysql();

$sql = "SELECT *
FROM usuarios as u
LEFT JOIN usuarios_seguidores as us on (us.id_usuario = $id_usuario and u.id = us.seguindo_id_usuario)
where usuario like '%$nome_pessoa%' And u.id <> $id_usuario ";
$resultado_id = mysqli_query($link,$sql);

if ($resultado_id){
    while($registro = mysqli_fetch_array($resultado_id,MYSQLI_ASSOC)){
      echo  '<a href="#"  class="list-group-item">';
        echo '<strong>'.$registro['usuario'].'<strong> <small> -'.$registro['email'].'</small>';
        echo '<p class="list-group-item-text pull-right">';
            $esta_seguindo_usuario_ns= isset($registro['id_usuario_seguidor']) && !empty($registro['id_usuario_seguidor']) ? 'S' : 'N';
            $btn_seguir_display='block';
            $btn_deixar_seguir_display = 'block';

            if($esta_seguindo_usuario_ns =='N'){
              $btn_deixar_seguir_display = 'none';
            }else{
              $btn_seguir_display='none';
            }
            echo '<button id="btn_seguir_'.$registro['id'].'" type="buton" class="btn btn-default btn_seguir" style="display:'.$btn_seguir_display.';" data-id_usuario="'.$registro['id'].'"> <i class="glyphicon glyphicon-heart-empty"></i></button>';
            echo '<button id="btn_deixar_seguir_'.$registro['id'].'" type="buton" class="btn btn-default btn_deixar_seguir" style="display:'.$btn_deixar_seguir_display.';" data-id_usuario="'.$registro['id'].'"> <i class="glyphicon glyphicon-remove"></i></button>';
        echo '</p>';
        echo '<div class="clearfix"></div>';
      echo '</a>';
    }
}else{
  echo 'erro na consulta';
}


 ?>
