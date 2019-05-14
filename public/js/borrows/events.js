$(document).ready(function () {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
		}
	});

	$('#btnAddBook').click(function(event) {
		event.preventDefault();
		var isbn = $('#isbn').val();
		var isRegistered = false;
		for(var i = 0; i < products.length; i++) {
			product = jQuery.parseJSON(products[i]);
			if (product.isbn == isbn) {	
				isRegistered = true; break;
			}
		}
		if (isRegistered)
			alert("El libro ya se encuentra registrado en la tabla...");
		else {
			$.ajax({
				url: $('#route').val()+'/'+isbn,
				method: 'GET',
				dataType: 'json',
				success: function(jsonObject) {
					addProduct(JSON.stringify(jsonObject));
				},
				error: function(jsonObject) {
					alert('No se encontró el ISBN...');
				}
			});
		}
		$('#isbn').val('');
	});

	$('#btnAccept').click(function(event) {
		$('#products').attr('value','['+products+']');
	});
});

var counter = 0;
var products = [];