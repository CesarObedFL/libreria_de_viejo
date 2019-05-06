$(document).ready(function () {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
		}
	});

	$('#btnAddBook').click(function(event) {
		event.preventDefault(); 
		searchProduct($('#isbn').val(),'book');
		$('#isbn').val('');
	});

	$('#btnAddPlant').click(function(event) {
		event.preventDefault();
		searchProduct($('#plantID').val(),'plant');
		$('#plantID').val('none');
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
				addProduct(JSON.stringify(jsonObject));
			},
			error: function(jsonObject) {
				alert('No se encontró ese producto...');
				//console.log(jsonObject);
			}
		});
	}
}