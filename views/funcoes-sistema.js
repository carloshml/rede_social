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
