<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: ../index.php?erro=1');
}

require_once('bd.class.php');
$id_usuario = isset($_REQUEST['id_usuario']) ? (int) $_REQUEST['id_usuario'] : 0;
if ($id_usuario === 0) {
  $id_usuario = $_SESSION['id_usuario'];
}

$objDB = new bd();
$link = $objDB->conecta_mysql();

$sql = "SELECT COUNT(*) as numero_seguidores from usuarios_seguidores where id_usuario_seguidor= $id_usuario";

if ($resultado_id = mysqli_query($link, $sql)) {
  $registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
  echo $registro['numero_seguidores'];

} else {
  echo 'erro de execução no banco';
}
?>