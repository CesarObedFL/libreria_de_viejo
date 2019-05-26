$(document).ready(function () {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
		}
	});

	$('#isbn').keypress(function(event) { // enter keycode = 13
		if(event.keyCode == 13) addBook();
	});

	$('#btnAddBook').click(function(event) {
		event.preventDefault();
		addBook();
	});

	$('#btnAccept').click(function(event) {
		$('#products').attr('value','['+products+']');
	});
});

var counter = 0;
var products = [];

function addBook() {
	var isbn = $('#isbn').val();
	if(isbn != '') {
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
					var object = JSON.stringify(jsonObject);
					if(jQuery.parseJSON(object).stock <= 0)
						alert('Stock en cero de ese producto...');
					else
						addProduct(object);
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
}