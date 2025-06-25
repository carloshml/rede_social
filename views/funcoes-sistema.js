function escreverMensagemNaTela(msg) {
  const container = $('#mensagem-upload');
  container.html('<span class="text-success">' + msg + '</span>');
  container.fadeIn(300);
  setTimeout(() => {
    container.fadeOut(300, function () {
      container.html('');
    });
  }, 1500);
}

function atualizaNumeroTwitter() {
  $.ajax({
    url: '../controllers/tweet-count-by-user.php',
    success: function (data) {
      $('#numero_tweets').html(data);
    }
  });
}

function atualizaNumeroSeguidores() {
  $.ajax({
    url: '../controllers/get_numero_seguidores.php',
    success: function (data) {
      $('#numero_seguidores').html(data);
    }
  });
}