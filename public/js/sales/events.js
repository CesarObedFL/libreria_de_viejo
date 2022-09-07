$(function () {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
		}
	});

	$('#isbn').on('keypress', function(event) {
		if(event.key == 'Enter') searchProduct($('#isbn').val(),'book');
	});

	$('#btnAddBook').on('click', function(event) {
		event.preventDefault(); 
		searchProduct($('#isbn').val(),'book');
	});

	$('#plant_id').on('keypress', function(event) {
		if(event.key == 'Enter') searchProduct($('#plant_id').val(),'plant');
	});

	$('#btnAddPlant').on('click', function(event) {
		event.preventDefault();
		searchProduct($('#plant_id').val(),'plant');
	});

	$('#productsTable').on('mousemove', function() {
		calculateTotal();
	});

	$('#btnAccept').on('click', function(event) {
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
			product = JSON.parse(products[i]);
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
					if(JSON.parse(object).stock <= 0)
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
		$('#plant_id').val('none');
	} else {
		alert('Ingrese un producto a buscar...');
	}
}