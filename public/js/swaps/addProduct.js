function addOutProduct(jsonObject) {
	var product = JSON.parse(jsonObject);
	outProducts.push(jsonObject);
	var row = '<tr id="outrow'+(++outCounter)+'">'+
				'<td class="danger">'+outCounter+'</td>'+
				'<td>'+product.isbn+'</td>'+
				'<td>'+product.title+'</td>'+

				'<td><input class="form-control price" type="number" min="5" max="1000"'+
					' onkeypress="typeNumber(event,2);"'+
					' name="price" id="price'+outCounter+'" value="'+product.price+'"'+
					' onchange="setPrice(\'out\','+outCounter+');"'+
					' style="width:90%;height:90%;" required></td>'+
				
				'<td><input class="form-control amount" type="number" min="1" max="10"'+
					' onkeypress="typeNumber(event,1);" onblur="validateAmount('+outCounter+');"'+
					' onchange="setAmount(\'out\','+outCounter+');"'+
					' name="amount" id="amount'+outCounter+'" value="1" style="width:90%;height:90%;" required></td>'+

				'<td><input class="form-control" name="stock" id="stock'+outCounter+'" value="'+product.stock+'"'+
					' style="width:90%;height:90%;" readonly></td>'+
				
				'<td><button class="btn btn-danger btn-block" id="btnCancelProduct"'+
					' onclick="cancelProduct('+outCounter+',1);" style="width:90%;height:80%;">&times;</button></td>'+
			'</tr>';
	$('#outProductsTable').append(row);
	calculateTotal();
}


function addInProduct(isbn) {
	var json = '{"isbn":"'+isbn+'","title":"title","price":"0","amount":"1"}';
	inProducts.push(json);
	var product = JSON.parse(json);
	var row = '<tr id="inrow'+(++inCounter)+'">'+
				'<td class="success">'+inCounter+'</td>'+
				'<td>'+product.isbn+'</td>'+

				'<td><input class="form-control" type="text"'+
					' name="title" id="title'+inCounter+'" value="'+product.title+'"'+
					' onblur="setTitle('+inCounter+');"'+
					' style="width:100%;height:90%;" required></td>'+

				'<td><input class="form-control price" type="number" min="5" max="1000"'+
					' onkeypress="typeNumber(event,2);"'+
					' name="price" id="in_price'+inCounter+'" value="'+product.price+'"'+
					' onchange="setPrice(\'in\','+inCounter+');"'+
					' style="width:90%;height:90%;" required></td>'+
				
				'<td><input class="form-control amount" type="number" min="1" max="10"'+
					' onkeypress="typeNumber(event,1);"'+
					' onchange="setAmount(\'in\','+inCounter+');"'+
					' name="amount" id="in_amount'+inCounter+'" value="'+product.amount+'" style="width:90%;height:90%;" required></td>'+

				'<td><button class="btn btn-danger btn-block" id="btnCancelProduct"'+
					' onclick="cancelProduct('+inCounter+',2);" style="width:90%;height:80%;">X</button></td>'+
			'</tr>';
	$('#inProductsTable').append(row);
	calculateTotal();
}