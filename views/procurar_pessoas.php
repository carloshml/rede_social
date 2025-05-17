<?php
  session_start();
  if (!isset($_SESSION['usuario'])){
    header('Location: index.php?erro=1');
  }
?>
<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">

		<title>Wiremotion</title>

		<!-- jquery - link cdn -->
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

		<!-- bootstrap - link cdn -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <script type="text/javascript">
    $(document).ready(function(){
      $('#btn_procurar_pessoa').click (function (){
        if ( $('#nome_pessoa').val().length > 0 ){
          $.ajax({
            url:'../controllers/get_pessoa.php',
            method: 'post',
            data: $('#form_procurar_pessoas').serialize(),
            success: function(data){
              $('#id_pessoas').html(data);
              $('.btn_seguir').click(function(){
                var id_usuario = $(this).data('id_usuario');
                  //ocultar botoes mostrar botão correto
                  $('#btn_seguir_'+id_usuario).hide();
                  $('#btn_deixar_seguir_'+id_usuario).show();
                $.ajax({
                  url:'../controllers/seguir.php',
                  method: 'post',
                  data: {seguir_id_usuario:id_usuario},
                  success: function(data){
                    atualizaNumeroSeguidores();
                  }
                });
              });
              $('.btn_deixar_seguir').click(function(){                
                var id_usuario = $(this).data('id_usuario');
                //ocultar botoes mostrar botão correto
                $('#btn_seguir_'+id_usuario).show();
                $('#btn_deixar_seguir_'+id_usuario).hide();
                $.ajax({
                  url:'../controllers/deixar_seguir.php',
                  method: 'post',
                  data: {deixar_seguir_id_usuario:id_usuario},
                  success: function(data){
                    atualizaNumeroSeguidores();
                  }
                });
              });
            }
          });
        }
      });
      function atualizaNumeroSeguidores(){
        $.ajax({
          url: '../controllers/get_numero_seguidores.php',
          success: function(data){
            $('#numero_seguidores').html(data);
          }
        });
      }

      function atualizaNumeroTwitter(){
        $.ajax({
          url: '../controllers/get_numero_tweets.php',
          success: function(data){
            $('#numero_tweets').html(data);
          }
        });
      }

      atualizaNumeroTwitter();
      atualizaNumeroSeguidores();
    });



    </script>
	</head>

	<body>

		<!-- Static navbar -->
	    <nav class="navbar navbar-default navbar-static-top">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
            <a href="home.php"><img src="../imagens/icone.png" /></a>
          </div>

	        <div id="navbar" class="navbar-collapse collapse">
	          <ul class="nav navbar-nav navbar-right">
              <li><a href="../home.php">Home</a></li>
	            <li><a href="../sair.php">Sair</a></li>
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </nav>

	    <div class="container">
    	    	<div class="col-md-3">
              <div class="panel panel-default">
                <div class="panel-body">
                  <h4><?= $_SESSION ['usuario']; ?></h4>
                  <hr/>
                  <div class="col-md-6">
                    TWEETS <br/>
                    <div class="" id="numero_tweets">

                    </div>

                  </div>
                  <div class="col-md-6" >
                    SEGUIDORES <br/>
                    <div class="" id="numero_seguidores" >

                    </div>
                  </div>
                </div>
              </div>
            </div>


    	    	<div class="col-md-6">
              <div class="panel panel-default">
                <div class="panel-body">
                  <form id="form_procurar_pessoas" class="input-group">
                    <input type="text" name="nome_pessoa" id="nome_pessoa" class="form-control" placeholder="Escreva o nome da pessoa procurada"  maxlength="140" >
                    <span class="input-group-btn">
                    <button type="button" id="btn_procurar_pessoa" class="btn btn-default" name="button"><i class="glyphicon glyphicon-search"></i></button>
                  </form>
                  </div>
                </div>
                <div class="list-group" id="id_pessoas">

                </div>
              </div>

  			</div>

		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

	</body>
</html>
