$(document).ready(function () {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
		}
	});

	$('#btnAddBook').click(function(event) {
		event.preventDefault();
		var isbn = $('#isbn').val();
		var isRegister = false;
		for(var i = 0; i < products.length; i++) {
			product = jQuery.parseJSON(products[i]);
			if (product.ID == isbn) {	
				isRegister = true; break;
			}
		}
		if (isRegister)
			alert("Ese libro ya se encuentra registrado en la tabla...");
		else {
			$.ajax({
				url: $('#route').val(),//'/searchBook'
				method: 'POST',
				data: {
					'ISBN': isbn//$('#isbn').val()
				},
				success: function(jsonObject) {
					addProduct(JSON.stringify(jsonObject));
				},
				error: function(data, textStatus, errorThrown) {
					alert('No se encontró el ISBN...');
				}
			});
		}
		$('#isbn').val('');
	});

	$('#btnAddPlant').click(function(event) {
		event.preventDefault();
		$.ajax({
			url: '/searchPlant',
			method: 'POST',
			data: {
				'plantID': $('#plantID').val()
			},
			success: function(jsonObject) {
				addProduct(JSON.stringify(jsonObject));
			},
			error: function(data) {
				alert('No se encontró esa planta...');
			}
		});
	});

	$('#productsTable').change(function() {
		calculateTotal();
	});

	$('#btnAccept').click(function(event) {
		$('#products').attr('value',products);
	});
});

var counter = 0;
var total = 0;
var products = [];