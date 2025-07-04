

function getSeguidores() {
	$.ajax({
		url: '../controllers/get_seguidores.php',
		success: function (data) {
			$('#followers').html(data);
			$('.btn_deixar_seguir').click(function () {
				var id_usuario = $(this).data('id_usuario');
				$.ajax({
					url: '../controllers/usuario-remover-seguidor.php',
					method: 'post',
					data: { deixar_seguir_id_usuario: id_usuario },
					success: function (data) {
						escreverMensagemNaTela('Removido!');
						getSeguidores();
						atualizaNumeroTwitter();
						atualizaNumeroSeguidores();
					}
				});
			});
		}
	});
}

getSeguidores();
atualizaNumeroTwitter();
atualizaNumeroSeguidores();