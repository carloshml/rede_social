<?php
class UsuarioUploader
{
  private $link;

  public function __construct()
  {
    $db = new bd();
    $this->link = $db->conecta_mysql();
  }

  public function verificarEmailExiste($email)
  {
    $stmt = $this->link->prepare("SELECT id FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    return $stmt->num_rows > 0;
  }

  public function atualizarFotoUsuario($usuario_id, $imagem)
  {
    $pasta = '../fotos/';
    $ext = pathinfo($imagem['name'], PATHINFO_EXTENSION);
    $nome_final = uniqid() . '.' . $ext;
    $destino = $pasta . $nome_final;

    $tipos_permitidos = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($imagem['type'], $tipos_permitidos)) {
      die('Tipo de imagem não permitido.');
    }

    if ($imagem['error'] !== 0 || !move_uploaded_file($imagem['tmp_name'], $destino)) {
      die('Erro ao fazer upload da imagem.');
    }

    $stmt = $this->link->prepare("UPDATE usuarios SET foto_usuario = ? WHERE id = ?");
    $stmt->bind_param("si", $nome_final, $usuario_id);
    if ($stmt->execute()) {
      header('Location: ../home.php');
      exit;
    } else {
      echo "<script>alert('Erro ao atualizar imagem do usuário.');</script>";
    }
  }

  public function seguir($usuario_id, $seguir_id_usuario)
  {
    if (!is_numeric($usuario_id) || !is_numeric($seguir_id_usuario)) {
      throw new InvalidArgumentException('IDs inválidos para seguir.');
    }

    $stmt = $this->link->prepare(
      "INSERT IGNORE INTO usuarios_seguidores (id_usuario, id_usuario_seguidor) VALUES (?, ?)"
    );
    $stmt->bind_param("ii", $usuario_id, $seguir_id_usuario);

    if (!$stmt->execute()) {
      throw new RuntimeException('Erro ao tentar seguir o usuário: ' . $stmt->error);
    }
  }

  public function deixarSeguir($usuario_id, $deixar_seguir_id_usuario)
  {
    if (!is_numeric($usuario_id) || !is_numeric($deixar_seguir_id_usuario)) {
      throw new InvalidArgumentException('IDs inválidos para deixar de seguir.');
    }

    $stmt = $this->link->prepare(
      "DELETE FROM usuarios_seguidores WHERE id_usuario = ? AND id_usuario_seguidor = ?"
    );
    $stmt->bind_param("ii", $usuario_id, $deixar_seguir_id_usuario);

    if (!$stmt->execute()) {
      throw new RuntimeException('Erro ao tentar deixar de seguir: ' . $stmt->error);
    }
  }
}
?>