<?php
require_once(__DIR__ . '/../controllers/bd.class.php');

class SeguidorService 
{
  private $link;

  public function __construct()
  {
    $db = new BD();
    $this->link = $db->conecta_database();
  }

  public function countFollowers($id_usuario)
  {
    $stmt = $this->link->prepare("
        SELECT COUNT(*) AS numero_seguidores
        FROM usuarios_seguidores
        WHERE id_usuario_seguidor = :id_usuario
    ");
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt->execute([
      ':id_usuario' => $id_usuario
    ]);
    $seguidoresQtd = $stmt->fetch(PDO::FETCH_ASSOC);
    return $seguidoresQtd;
  }

}