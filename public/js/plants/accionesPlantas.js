$(document).ready(function(){
	/*$('.btn-deleteProduct').click(function (e) {
		e.preventDefault();
		cancel();
	});*/

	$('.btn-addProduct').click(function (e) {
		e.preventDefault();
		add();
	});
	
	/*
	$(".modificar").click(function(){
		var answer = confirm("¿Deseas modificar este registro?")
		
		if (answer){			    	 
			var isbn=$(this).parent('td').parent('tr').find('.isbn').val();
			var titulo=$(this).parent('td').parent('tr').find('.titulo').val();
			var autor=$(this).parent('td').parent('tr').find('.autor').val();
			var editorial=$(this).parent('td').parent('tr').find('.editorial').val();
			var edicion=$(this).parent('td').parent('tr').find('.edicion').val();
			var condiciones=$(this).parent('td').parent('tr').find('.condiciones').val();
			var clasificacion=$(this).parent('td').parent('tr').find('.clasificacion').val();
			var ubicacion=$(this).parent('td').parent('tr').find('.ubicacion').val();
			var cantidad=$(this).parent('td').parent('tr').find('.cantidad').val();
			var precio=$(this).parent('td').parent('tr').find('.precio').val();

			$.post('modificarLibro.php',{
				Caso:'Modificar',
				Id:$(this).attr('data-id'),
				ISBN:isbn,
				Titulo:titulo,			
				Autor:autor,
				Editorial:editorial,
				Edicion:edicion,
				Condiciones:condiciones,
				Clasificacion:clasificacion,
				Ubicacion:ubicacion,
				Cantidad:cantidad,
				Precio:precio
			},function(e){
				alert(e);
			});
			
		} else{
		    // do nothing
		}
	});
	*/

});

var productCounter = 1;

function cancel(i) {
	if(confirm("¿Deseas cancelar registro ("+i+") de la venta?...")) {
		//($(this).parents('tr')).fadeOut(); // se elimina la fila de la tabla de ventas
		//var i = r.parentNode.parentNode.rowIndex;
		var table = document.getElementById('products');

		document.getElementById('products').deleteRow(i);
		productCounter -= 1;
	}
}

function add() {
	var product = document.getElementById('product').value.split('_');

	var table = document.getElementById('products');
	var lastRow = table.rows.length;
	var row = table.insertRow(lastRow);

	(row.insertCell(0)).innerHTML = product[1]; // name
	(row.insertCell(1)).innerHTML = product[2]; // tips
	(row.insertCell(2)).innerHTML = '<input class="form-control" name="price" id="price" value="'+product[3]+'">'; // price
	(row.insertCell(3)).innerHTML = '<input class="form-control" type="number" name="amount" id="amount" value="0">'; 		// amount
	(row.insertCell(4)).innerHTML = '<input class="form-control" type="number" name="discount" id="discount" value="0">'; 		// discount
	(row.insertCell(5)).innerHTML = product[4]; // stock
	(row.insertCell(6)).innerHTML = '<button class="btn btn-danger btn-block btn-deleteProduct" onClick="cancel('+product[0]+')">X';
	productCounter += 1;
	return false;
}
