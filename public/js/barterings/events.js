$(document).ready(function () {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
		}
	});

	$('#btnOut').click(function(event) {
		event.preventDefault();
		var isbn = $('#isbn').val();
		var isRegistered = false;
		for(var i = 0; i < outProducts.length; i++) {
			product = jQuery.parseJSON(outProducts[i]);
			if (product.isbn == isbn) {	
				isRegistered = true; break;
			}
		}
		if (isRegistered)
			alert("El libro ya se encuentra registrado en la tabla de salidas...");
		else {
			$.ajax({
				url: $('#route').val()+'/'+isbn,
				method: 'GET',
				dataType: 'json',
				success: function(jsonObject) {
					addOutProduct(JSON.stringify(jsonObject));
				},
				error: function(jsonObject) {
					alert('No se encontró el ISBN...');
					//console.log(jsonObject);
				}
			});
		}
		$('#isbn').val('');
	});

	$('#btnIn').click(function(event) {
		event.preventDefault();
		var isbn = $('#isbn').val();
		var isRegister = false;
		for(var i = 0; i < inProducts.length; i++) {
			if (inProducts[i] == isbn) {	
				isRegister = true; break;
			}
		}
		if (isRegister)
			alert("El libro ya se encuentra registrado en la tabla de entradas...");
		else {
			addInProduct(isbn);
		}
		$('#isbn').val('');

	});

	$('#btnAccept').click(function(event) {
		$('#inProducts').attr('value','['+inProducts+']');
		$('#outProducts').attr('value','['+outProducts+']');
	});
});

var inCounter = 0;
var outCounter = 0;
var inProducts = [];
var outProducts = [];