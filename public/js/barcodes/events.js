$(function () {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
		}
	});

	$('#booktitle').on('keypress', function(event) { // enter keycode = 13
		if(event.key == 'Enter') {
			addBook();
		}
	});

	$('#btnAddBook').on('click', function(event) {
		event.preventDefault();
		addBook();
	});

	$('#btnAccept').on('click', function(event) {
		$('#books').attr('value','['+books+']');
	});
});

var counter = 0;
var books = [];

function addBook() {
	var booktitle = $('#booktitle').val();
	console.log(booktitle);
	if(booktitle != '') {
		var isRegistered = false;
		for(var i = 0; i < books.length; i++) {
			book = JSON.parse(books[i]);
			if (book.title == booktitle) {	
				isRegistered = true; break;
			}
		}
		if (isRegistered)
			alert("El libro ya se encuentra registrado en la tabla...");
		else {
			$.ajax({
				url: $('#route').val()+'/'+booktitle,
				method: 'GET',
				dataType: 'json',
				success: function(jsonObject) {
					var object = JSON.stringify(jsonObject);
					addProduct(object);
				},
				error: function(jsonObject) {
					alert('No se encontró el título de ese libro...');
				}
			});
		}
		$('#booktitle').val('');
	} else {
		alert('Ingrese un título a buscar...');
	}
}