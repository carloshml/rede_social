<?php
require_once(__DIR__ . '/../controllers/bd.class.php');

class UsuarioUploader
{
  private $link;

  public function __construct()
  {
    $db = new BD();
    $this->link = $db->conecta_mysql();
  }

  public function verificarEmailExiste($email)
  {
    $stmt = $this->link->prepare("SELECT id FROM usuarios WHERE email = :email");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
  }

  public function atualizarFotoUsuario($usuario_id, $imagem)
  {
    $pasta = '../fotos/';
    $ext = pathinfo($imagem['name'], PATHINFO_EXTENSION);
    $nome_final = uniqid() . '.' . $ext;
    $destino = $pasta . $nome_final;

    $tipos_permitidos = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($imagem['type'], $tipos_permitidos)) {
      throw new RuntimeException('Tipo de imagem não permitido.');
    }

    if ($imagem['error'] !== 0 || !move_uploaded_file($imagem['tmp_name'], $destino)) {
      throw new RuntimeException('Erro ao fazer upload da imagem.');
    }

    $stmt = $this->link->prepare("UPDATE usuarios SET foto_usuario = :foto WHERE id = :id");
    $stmt->bindParam(':foto', $nome_final, PDO::PARAM_STR);
    $stmt->bindParam(':id', $usuario_id, PDO::PARAM_INT);
    $stmt->execute();
    exit;
  }

  public function seguir($usuario_id, $seguir_id_usuario)
  {
    if (!is_numeric($usuario_id) || !is_numeric($seguir_id_usuario)) {
      throw new InvalidArgumentException('IDs inválidos para seguir.');
    }

    $stmt = $this->link->prepare("
            INSERT IGNORE INTO usuarios_seguidores (id_usuario, id_usuario_seguidor)
            VALUES (:usuario_id, :seguir_id)
        ");
    $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
    $stmt->bindParam(':seguir_id', $seguir_id_usuario, PDO::PARAM_INT);
    $stmt->execute();
  }

  public function deixarSeguir($usuario_id, $deixar_seguir_id_usuario)
  {
    if (!is_numeric($usuario_id) || !is_numeric($deixar_seguir_id_usuario)) {
      throw new InvalidArgumentException('IDs inválidos para deixar de seguir.');
    }

    $stmt = $this->link->prepare("
            DELETE FROM usuarios_seguidores 
            WHERE id_usuario = :usuario_id AND id_usuario_seguidor = :seguindo_id
        ");
    $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
    $stmt->bindParam(':seguindo_id', $deixar_seguir_id_usuario, PDO::PARAM_INT);
    $stmt->execute();
  }

  public function fotoUsuario()
  {
    $id_usuario = $_SESSION['id_usuario'] ?? null;
    if (!$id_usuario) {
      throw new RuntimeException('Usuário não autenticado.');
    }

    $stmt = $this->link->prepare("SELECT * FROM usuarios WHERE id = :id");
    $stmt->bindParam(':id', $id_usuario, PDO::PARAM_INT);
    $stmt->execute();

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$usuario) {
      throw new RuntimeException('Usuário não encontrado.');
    }

    return $usuario;
  }

  public function fotobyUsuario($id_usuario)
  {
    $stmt = $this->link->prepare("SELECT * FROM usuarios WHERE id = :id");
    $stmt->bindParam(':id', $id_usuario, PDO::PARAM_INT);
    $stmt->execute();

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$usuario) {
      throw new RuntimeException('Usuário não encontrado.');
    }

    return $usuario;
  }
}