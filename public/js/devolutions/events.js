$(document).ready(function () {

	$('#btnAddBook').click(function(event) {
		event.preventDefault();
		var isbn = $('#isbn').val();
		var isRegister = false;
		for(var i = 0; i < products.length; i++) {
			product = jQuery.parseJSON(products[i]);
			if (product.isbn == isbn) {	
				isRegister = true; break;
			}
		}
		if (isRegister)
			alert("El libro ya se encuentra registrado en la tabla...");
		else {
			addProduct(isbn);
		}
		$('#isbn').val('');
	});

	$('#btnAccept').click(function(event) {
		$('#products').attr('value','['+products+']');
	});
});

var counter = 0;
var products = [];