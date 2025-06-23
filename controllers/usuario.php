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

    if ($seguir_id_usuario == '' || $usuario_id == '') {
      die();
    }  
    

    $sql = "INSERT INTO usuarios_seguidores(id_usuario,id_usuario_seguidor) values ($usuario_id,$seguir_id_usuario) ";
    mysqli_query($this->link, $sql);
  }

  public function deixarSeguir($usuario_id, $deixar_seguir_id_usuario)
  { 

    if ($deixar_seguir_id_usuario == '' || $usuario_id == '') {
      die();
    }  
    

    $sql = " DELETE FROM usuarios_seguidores WHERE id_usuario= $usuario_id AND id_usuario_seguidor = $deixar_seguir_id_usuario ";
    mysqli_query($this->link, $sql);
  }
}
 ?>