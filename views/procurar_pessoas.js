$(document).ready(function () {
  $('#btn_procurar_pessoa').click(function () {
    if ($('#nome_pessoa').val().length > 0) {
      $.ajax({
        url: '../controllers/usuario-listar-usuarios.php',
        method: 'post',
        data: $('#form_procurar_pessoas').serialize(),
        success: function (data) {

          $('#id_pessoas').html(data);

          $('.btn_seguir').click(function () {
            var id_usuario = $(this).data('id_usuario');
            //ocultar botoes mostrar botão correto
            $('#btn_seguir_' + id_usuario).hide();
            $('#btn_deixar_seguir_' + id_usuario).show();
            $.ajax({
              url: '../controllers/usuario-seguir.php',
              method: 'post',
              data: { seguir_id_usuario: id_usuario },
              success: function (data) {
                atualizaNumeroSeguidores();
              }
            });
          });

          $('.btn_deixar_seguir').click(function () {
            var id_usuario = $(this).data('id_usuario');
            //ocultar botoes mostrar botão correto
            $('#btn_seguir_' + id_usuario).show();
            $('#btn_deixar_seguir_' + id_usuario).hide();
            $.ajax({
              url: '../controllers/usuario-deixar-seguir.php',
              method: 'post',
              data: { deixar_seguir_id_usuario: id_usuario },
              success: function (data) {
                atualizaNumeroSeguidores();
              }
            });
          });

        }
      });
    }
  });
  function atualizaNumeroSeguidores() {
    $.ajax({
      url: '../controllers/get_numero_seguidores.php',
      success: function (data) {
        $('#numero_seguidores').html(data);
      }
    });
  }

  function atualizaNumeroTwitter() {
    $.ajax({
      url: '../controllers/tweet-count-by-user.php',
      success: function (data) {
        $('#numero_tweets').html(data);
      }
    });
  }
  atualizaNumeroTwitter();
  atualizaNumeroSeguidores();
});