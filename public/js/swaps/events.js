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
			var product = jQuery.parseJSON(inProducts[i]);
			if (product.isbn == isbn) {	
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

	$('#inProductsTable').change(function() {
		calculateTotal();
	});

	$('#outProductsTable').change(function() {
		calculateTotal();
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
var total = 0;