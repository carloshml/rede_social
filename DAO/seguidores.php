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
        FROM seguidores
        WHERE seguidores.id_usuario_seguidor = :id_usuario
    ");
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt->execute([
      ':id_usuario' => $id_usuario
    ]);
    $seguidoresQtd = $stmt->fetch(PDO::FETCH_ASSOC);
    return $seguidoresQtd;
  }

  public function getFollowers($id_usuario)
  {
    $sql = "
        SELECT u.id  as id_follower,  foto_usuario , u.usuario
        FROM usuarios u
        inner JOIN seguidores us ON us.id_usuario = u.id          
        WHERE us.id_usuario_seguidor = :id_usuario
    ";

    $stmt = $this->link->prepare($sql);
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt->execute();
    $seguidores = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $seguidores;
  }

  public function seguir($usuario_id, $seguidor_id)
  {
    if (!is_numeric($usuario_id) || !is_numeric($seguidor_id)) {
      throw new InvalidArgumentException('IDs inválidos para seguir.');
    }

    $stmt = $this->link->prepare("
            INSERT IGNORE INTO seguidores (id_usuario, id_usuario_seguidor)
            VALUES (:usuario_id, :seguidor_id)
        ");
    $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
    $stmt->bindParam(':seguidor_id', $seguidor_id, PDO::PARAM_INT);
    $stmt->execute();
  }


  public function deixarSeguir($usuario_id, $seguidor_id)
  {
    if (!is_numeric($usuario_id) || !is_numeric($seguidor_id)) {
      throw new InvalidArgumentException('IDs inválidos para deixar de seguir.');
    }

    $stmt = $this->link->prepare("
            DELETE FROM seguidores 
            WHERE id_usuario = :usuario_id AND id_usuario_seguidor = :seguidor_id
        ");
    $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
    $stmt->bindParam(':seguidor_id', $seguidor_id, PDO::PARAM_INT);
    $stmt->execute();
  }

  public function removerSeguidor($usuario_id, $seguidor_id)
  {
    if (!is_numeric($usuario_id) || !is_numeric($seguidor_id)) {
      throw new InvalidArgumentException('IDs inválidos para deixar de seguir.');
    }

    $stmt = $this->link->prepare("
            DELETE FROM seguidores 
            WHERE id_usuario = :usuario_id AND id_usuario_seguidor = :seguidor_id
        ");
    $stmt->bindParam(':usuario_id', $seguidor_id, PDO::PARAM_INT);
    $stmt->bindParam(':seguidor_id', $usuario_id, PDO::PARAM_INT);
    $stmt->execute();
  }

}