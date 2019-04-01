$(document).ready(function () {
	$('#btnCancelProduct').click(function (e) {
		e.preventDefault();
		if(confirm("¿Deseas cancelar éste registro de la venta?...")) {
			//var row = $(this).parents('tr');
			($(this).parents('tr')).fadeOut(); // se elimina la fila de la tabla de ventas
			//var id = row.data('id');
			//var form = $('#form-delete');
			//var url = form.attr('action').replace(':PLANT_ID',id);
			//var data = form.serialize();

		} // else {
			// do nothing
		//}
	});
});

/*
$(document).ready(function () {
	$('.btn-delete').click(function (e) {
		e.preventDefault();
		//if(confirm("¿Deseas cancelar éste registro?...")) {
			var row = $(this).parents('tr');
			var id = row.data('id');
			var form = $('#form-delete');
			var url = form.attr('action').replace(':PLANT_ID',id);
			var data = form.serialize();
			row.fadeOut();

			$.post(url, data, function (result) {
				alert(result);
			}).fail(function () {
				alert('Ocurrio un error en el servidor...'.
					'/nEl registro no fue eliminado...');
				row.show();
			});

		//} else {
			// do nothing
		//}


	});
});
//*/

/*
function cancelProduct(index) {
	var answer = confirm("¿Deseas cancelar éste registro?...")
	if (answer) {
		$("#fila" + index).remove();
		$(this).closest('tr').remove();
		//$(this).parent('td').parent('tr').remove();
		/*$.post('modificarLibro.php',{
			Caso:'Eliminar',
			Id:$(this).attr('data-id')
		},function(e){	
			alert(e);
		});*
	} else {
		// do nothing
	}
}
*/