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

    $arquivo = $_FILES['imagem']['name'];
    //pasta para salvar arquivo;
    $_UP['pasta'] = 'fotos/';


    if($_FILES['imagem']['error']!=0){
      echo 'erro no upload da imagem';
        die();
    }

    $nome_final = $_FILES['imagem']['name'];
    //verificar se é possível mover o arquivo para a pasta escolhida
    $query = false ;
    if(move_uploaded_file($_FILES['imagem']['tmp_name'],$_UP['pasta'].$nome_final)){
      //upload afetuado com sucesso
      $sql = "INSERT INTO usuarios(usuario, email, senha,foto_usuario) VALUES('$usuario', '$email', '$senha','$nome_final')";
      // execultar a query ;
      if (mysqli_query($link,$sql)){
        echo "<script type=\"text/javascript\">;
                    alert('imagem cadastrada com sucesso');
                </script>" ;
        header('Location: index.php');
      }else{
        echo "<script type=\"text/javascript\">;
                    alert('Usuario Não Foi cadastrado');
                </script>" ;
      }

    }

 ?>
