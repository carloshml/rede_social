
$(document).ready(function () {
  $('#btn_tweet').click(function () {
    if ($('#texto_tweet').val().length > 0) {
      $.ajax({
        url: 'controllers/inclui_tweet.php',
        method: 'post',
        data: $('#form_tweet').serialize(),
        success: function (data) {
          $('#texto_tweet').val('');
          atualizaTweet();
          atualizaNumeroTwitter();
        }
      });
    }
  });

  function atualizaTweet() {
    $.ajax({
      url: 'controllers/get_twitter.php',
      success: function (data) {
        $('#tweets').html(data);
        $('.btn_apaga_tweet').click(function () {
          var id_tweet = $(this).attr('id');
          $.ajax({
            url: 'controllers/apagar_tweet.php',
            method: 'post',
            data: { id_tweet: id_tweet },
            success: function (data) {
              atualizaTweet();
            }
          });
        });
      }
    });
  }

  function atualizaNumeroTwitter() {
    $.ajax({
      url: 'controllers/get_numero_tweets.php',
      success: function (data) {
        $('#numero_tweets').html(data);
      }
    });
  }

  atualizaTweet();
  atualizaNumeroTwitter();
});
