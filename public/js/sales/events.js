$(document).ready(function () {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
		}
	});

	$('#isbn').keypress(function(event) {
		if(event.keyCode == 13) searchProduct($('#isbn').val(),'book');
	});

	$('#btnAddBook').click(function(event) {
		event.preventDefault(); 
		searchProduct($('#isbn').val(),'book');
	});

	$('#plantID').keypress(function(event) {
		if(event.keyCode == 13) searchProduct($('#plantID').val(),'plant');
	});

	$('#btnAddPlant').click(function(event) {
		event.preventDefault();
		searchProduct($('#plantID').val(),'plant');
	});

	$('#productsTable').change(function() {
		calculateTotal();
	});

	$('#btnAccept').click(function(event) {
		$('#products').attr('value','['+products+']');
	});
});

var counter = 0;
var total = 0;
var products = [];

function searchProduct(productID,routeType) {
	if(productID != '') {
		var isRegistered = false;
		for(var i = 0; i < products.length; i++) {
			product = jQuery.parseJSON(products[i]);
			if (product.id == productID) {
				isRegistered = true; break;
			}
		}
		if (isRegistered)
			alert("Ese producto ya se encuentra registrado en la tabla...");
		else {
			$.ajax({
				url: $('#route'+routeType).val()+'/'+productID,
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
					alert('No se encontró ese producto...');
				}
			});
		}
		$('#isbn').val('');
		$('#plantID').val('none');
	} else {
		alert('Ingrese un producto a buscar...');
	}
}