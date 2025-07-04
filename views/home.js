
$(document).ready(function () {
  $('#btn_tweet').click(function () {
    if ($('#texto_tweet').val().length > 0) {
      $.ajax({
        url: '../controllers/tweet-post.php',
        method: 'post',
        data: $('#form_tweet').serialize(),
        success: function (data) {
          escreverMensagemNaTela('sucesso!');
          $('#texto_tweet').val('');
          atualizaTweet();
          atualizaNumeroTwitter();
        }
      });
    }
  });

  function atualizaTweet() {
    $.ajax({
      url: '../controllers/twitter-listar-tweets_usuarios.php',
      success: function (data) {
        $('#tweets').html(data);
        addEventoBtnDeletarTweet();
      }
    });
  }

  function addEventoBtnDeletarTweet() {
    $('.btn_apaga_tweet').click(function () {
      var id_tweet = $(this).attr('id');
      $.ajax({
        url: '../controllers/tweet-apagar.php',
        method: 'post',
        data: { id_tweet: id_tweet },
        success: function (data) {
          escreverMensagemNaTela('Apagado!');
          atualizaTweet();
          atualizaNumeroTwitter();
        }
      });
    });
  }



  atualizaTweet();
  atualizaNumeroTwitter();
  atualizaNumeroSeguidores();
});
