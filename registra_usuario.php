<?php
//Convoca a classe de Conexão ao Bando de Dados e efetua a conexão.
require_once('bd.class.php');
//Declara variáveis com dados do formulário
$usuario = $_POST['usuario'];
$email = $_POST['email'];
$senha = md5($_POST['senha']);
//Insere dados de novo usuário na tabela.

$objBd = new bd();
$link = $objBd->conecta_mysql();
$usuario_existe = false ;
$email_existe = false ;

    //veririfcar se o usuario já existe

    $sql = "select * from usuarios where usuario = '$usuario'";
    if ($resultado_id = mysqli_query($link,$sql)){
      $dados_usuario = mysqli_fetch_array($resultado_id);
      if (isset ($dados_usuario['usuario'])){
        $usuario_existe = true ;
      }
    }else{
      echo 'erro ao tentar encontrar o registro de usuario';
    }

    // veririfcar se o email já existe

    $sql = "select * from usuarios where email = '$email'";
    if ($resultado_id = mysqli_query($link,$sql)){
      $dados_usuario = mysqli_fetch_array($resultado_id);
      if (isset ($dados_usuario['email'])){
        $email_existe = true;
      }
    }else{
      echo 'erro ao tentar encontrar o registro de email';
    }

    if ($usuario_existe || $email_existe){
      $retorno_get= '';

      if ($usuario_existe){
        $retorno_get.="erro_usuario=1&";
      }

      if($email_existe){
        $retorno_get.= "erro_email=1&";
      }

      header ('Location: inscrevase.php?'.$retorno_get);
      die();
    }


    $sql = "INSERT INTO usuarios(usuario, email, senha) VALUES('$usuario', '$email', '$senha')";
    // execultar a query ;
    if (mysqli_query($link,$sql)){
      header('Location: index.php');
    }else{
      echo 'usuario não foi cadastrado';
    }


 ?>
