function addProduct(jsonObject) {
	$('#btnAccept').removeAttr('disabled');
	var product = jQuery.parseJSON(jsonObject);
	products[counter] = JSON.stringify(product);
	var row = '<tr id="row'+(++counter)+'">'+
				'<td>'+product.isbn+'</td>'+
				
				'<td><input class="form-control amount" type="number" min="1" max="'+product.stock+
					'" onkeypress="typeNumber(event,1);" onblur="validateAmount('+counter+');"'+
					' name="amount" id="amount'+counter+'" value="1" required></td>'+

				'<td><button class="btn btn-danger btn-block" id="btnCancelProduct"'+
					' onclick="cancelProduct('+counter+');">&times;</button></td>'+
			'</tr>';
	$('#returnsTable').append(row);
}