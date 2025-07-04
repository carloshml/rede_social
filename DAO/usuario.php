<?php
require_once(__DIR__ . '/../config/bd.class.php');

class UsuarioService
{
  private $link;

  public function __construct()
  {
    $db = new BD();
    $this->link = $db->conecta_database();
  }

  public function verificarEmailExiste($email)
  {
    $stmt = $this->link->prepare("SELECT id FROM usuarios WHERE email = :email");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
  }

  public function existeUsuarioOuEmail($usuario, $email)
  {
    $stmt = $this->link->prepare("SELECT usuario, email FROM usuarios WHERE usuario = :usuario OR email = :email");
    $stmt->execute([
      ':usuario' => $usuario,
      ':email' => $email
    ]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
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

  public function getFotobyUsuario($id_usuario)
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

  public function cadastrarUsuario($usuario, $email, $senha, $foto_usuario)
  {
    $stmt = $this->link->prepare("INSERT INTO usuarios (usuario, email, senha, foto_usuario) VALUES (:usuario, :email, :senha, :foto)");
    return $stmt->execute([
      ':usuario' => $usuario,
      ':email' => $email,
      ':senha' => $senha,
      ':foto' => $foto_usuario
    ]);
  }

}