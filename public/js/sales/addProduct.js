function addProduct(jsonObject) {
	$('#btnAccept').removeAttr('disabled');
	var product = jQuery.parseJSON(jsonObject);
	products[counter] = JSON.stringify(product);
	var row = '<tr id="row'+(++counter)+'">'+
				'<td style="width:5%" class="success">'+counter+'</td>'+
				'<td style="width:15%">'+product.id+'</td>'+
				'<td style="width:30%">'+product.name+'</td>'+

				'<td><input class="form-control price" type="number" min="5" max="1000"'+
					' onkeypress="typeNumber(event,2);"'+
					' name="price" id="price'+counter+'" value="'+product.price+
					'" style="width:90%;height:90%;" required></td>'+
				
				'<td><input class="form-control amount" type="number" min="1" max="'+product.stock+
					'" onkeypress="typeNumber(event,1);" onblur="validateAmount('+counter+');"'+
					' name="amount" id="amount'+counter+'" value="'+product.amount+'" style="width:90%;height:90%;" required></td>'+

				'<td><input class="form-control discount" type="number" min="0" max="20"'+
					' onkeypress="typeNumber(event,1)" onblur="validateDiscount('+counter+')"'+
					' name="discount" id="discount'+counter+'" value="'+product.discount+'" style="width:90%;height:90%;"></td>'+
				
				'<td><input class="form-control" name="stock" id="stock'+counter+'" value="'+product.stock+
					'"style="width:90%;height:90%;" readonly></td>'+

				'<td><button class="btn btn-danger btn-block" id="btnCancelProduct"'+
					' onclick="cancelProduct('+counter+');" style="width:90%;height:80%;">&times;</button></td>'+
			'</tr>';
	$('#productsTable').append(row);
	calculateTotal();
}