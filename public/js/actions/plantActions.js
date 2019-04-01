$(document).ready(function () {
	$('#btnAddProduct').click(function (event) {
		event.preventDefault();
		addProduct();
		$('#product').val("none"); // se pone el selector de productos en blanco
	});

	/*$('#btnCancelProduct').click(function (event) {
		// si no hay productos en la tabla deshabilitar el boton de aceptar...
		console.log("eliminando producto...");
		event.preventDefault();
		//cancel();
		if(confirm("¿Deseas cancelar éste registro de la venta?...")) {
			//var row = $(this).parents('tr');
			($(this).parents('tr')).remove(); // se elimina la fila de la tabla de ventas

		}
	});*/

	$('#products').change(function() {
		calculateTotal();
	});
});

var counter = 0;
var total = 0;
var subtotal = [];

function addProduct() {
	// si hay productos en la tabla habilitar el boton de aceptar

	var product = document.getElementById('product').value.split('_');
	$('#btnAccept').removeAttr('disabled');

	if(product != "") {
		var row = '<tr id="row'+(++counter)+'">'+
					'<td style="width:5%">'+counter+'</td>'+
					'<td style="width:15%">'+product[1]+'</td>'+
					'<td style="width:30%">'+product[2]+'</td>'+

					'<td><input class="form-control" type="number" min="5" max="1000" onkeypress="return typeRealNumber(event);"'+
						' name="price" id="price'+counter+'" value="'+product[3]+'" style="width:90%;height:90%;" required></td>'+
					
					'<td><input class="form-control" type="number" min="1" max="'+product[4]+'" onblur="return validateAmount();"'+
						' name="amount" id="amount'+counter+'" value="1" style="width:90%;height:90%;" required></td>'+
					
					'<td><input class="form-control" type="number" min="0" max="20"'+
						' name="discount" id="discount'+counter+'" value="0" style="width:90%;height:90%;"></td>'+
					
					'<td><input class="form-control" name="stock" id="stock'+counter+'" value="'+product[4]+'"style="width:90%;height:90%;" disabled></td>'+
					'<td><button class="btn btn-danger btn-block" id="btnCancelProduct" onclick="cancelProduct('+counter+');" style="width:90%;height:80%;">X</button></td>'+
				'</tr>';
		$('#products').append(row);
		calculateTotal();
	} else {
		alert("Elige una planta a vender...");
	}
}

function cancelProduct(index) {
	//if(confirm("Seguro de cancelar este producto de la venta?...")) {
		$('#row'+index).remove();
		reOrder();
		counter--;
		calculateTotal();
	//}
}

function calculateTotal() {
	total = 0;
	for (var i = 1; i <= counter; i++){
		price = $('#price'+i).val();
		amount = $('#amount'+i).val();
		discount = $('#discount'+i).val();

		subtotal[i] = price * amount;
		total += subtotal[i] - (subtotal[i] * (discount/100));
		console.log(price+" "+amount+" "+discount+" "+subtotal[i].toFixed(2)+" "+total.toFixed(2));
	}
	$("#total").val(total.toFixed(2));
}

function reOrder() {
	var index = 0;
	$('#products tbody tr').each(function() {
		$(this).find('td').eq(0).text(++index);
		//console.log($(this).find('td').eq(3).find('input').val());
		$(this).find('td').eq(3).find('input').attr('id','price'+index);
		$(this).find('td').eq(4).find('input').attr('id','amount'+index);
		$(this).find('td').eq(5).find('input').attr('id','discount'+index);
		//$(this).find('td').eq(-1).find('button').attr('onclick','cancelProduct('+index+');');
	});
}