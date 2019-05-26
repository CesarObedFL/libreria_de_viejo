$(document).ready(function () {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
		}
	});

	$('#btnOut').click(function(event) {
		event.preventDefault();
		var isbn = $('#isbn').val();
		if(isbn != '') {
			var isRegistered = false;
			for(var i = 0; i < outProducts.length; i++) {
				var product = jQuery.parseJSON(outProducts[i]);
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
						var object = JSON.stringify(jsonObject);
		                if(jQuery.parseJSON(object).stock <= 0)
		                    alert('Stock en cero de ese producto...');
		                else
		                    addOutProduct(object);
					},
					error: function(jsonObject) {
						alert('No se encontró el ISBN...');
					}
				});
			}
			$('#isbn').val('');
		} else {
			alert('Ingrese un ISBN a buscar...');
		}
	});

	$('#btnIn').click(function(event) {
		event.preventDefault();
		var isbn = $('#isbn').val();
		var isRegistered = false;
		for(var i = 0; i < inProducts.length; i++) {
			var product = jQuery.parseJSON(inProducts[i]);
			if (product.isbn == isbn) {	
				isRegistered = true; break;
			}
		}
		if (isRegistered)
			alert("El libro ya se encuentra registrado en la tabla de entradas...");
		else
			addInProduct(isbn);
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