
$(document).ready(function(){
  $('#btn_tweet').click (function (){

    if ( $('#texto_tweet').val().length > 0 ){
      $.ajax({
        url:'inclui_tweet.php',
        method: 'post',
        data: $('#form_tweet').serialize(),
        success: function(data){
          $('#texto_tweet').val('');
          atualizaTweet();
          atualizaNumeroTwitter();
        }
      });
    }
  });

  function atualizaTweet(){
    $.ajax({
      url: 'get_twitter.php',
      success: function(data){
        $('#tweets').html(data);
        $('.btn_apaga_tweet').click(function(){
          var id_tweet = $(this).attr('id');
          $.ajax({
            url: 'apagar_tweet.php',
            method: 'post',
            data: {id_tweet:id_tweet},
            success: function(data){
              atualizaTweet();
            }
          });
        });
      }
    });
  }

  function atualizaNumeroTwitter(){
    $.ajax({
      url: 'get_numero_tweets.php',
      success: function(data){
        $('#numero_tweets').html(data);
      }
    });
  }

  atualizaTweet();
  atualizaNumeroTwitter();
});
