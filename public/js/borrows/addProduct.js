function addProduct(jsonObject) {
	// si hay productos en la tabla habilitar el boton de aceptar
	$('#btnAccept').removeAttr('disabled');
	products[counter] = jsonObject;
	var product = jQuery.parseJSON(jsonObject);
	var row = '<tr id="row'+(++counter)+'">'+
				'<td style="width:5%" class="success">'+counter+'</td>'+
				'<td style="width:15%">'+product.isbn+'</td>'+
				'<td style="width:30%">'+product.title+'</td>'+
				
				'<td><input class="form-control amount" type="number" min="1" max="'+product.stock+
					'" onkeypress="typeNumber(event,1);" onblur="validateAmount('+counter+');"'+
					' name="amount" id="amount'+counter+'" value="'+product.amount+'" style="width:90%;height:90%;" required></td>'+
				
				'<td><input class="form-control" name="stock" id="stock'+counter+'" value="'+product.stock+
					'"style="width:90%;height:90%;" readonly></td>'+

				'<td><button class="btn btn-danger btn-block" id="btnCancelProduct"'+
					' onclick="cancelProduct('+counter+');" style="width:90%;height:80%;">X</button></td>'+
			'</tr>';
	$('#productsTable').append(row);
}