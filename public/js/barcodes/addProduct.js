function addProduct(jsonObject) {
	$('#btnAccept').removeAttr('disabled');
	books[counter] = jsonObject;
	var book = jQuery.parseJSON(jsonObject);
	var row = '<tr id="row'+(++counter)+'">'+
				'<td style="width:10%" class="success">'+counter+'</td>'+
				'<td style="width:50%">'+book.title+'</td>'+
				'<td style="width:30%">'+book.isbn+'</td>'+

				'<td><input class="form-control amount" type="number" min="1"'+
					' onkeypress="typeNumber(event,1);" onblur="validateAmount('+counter+');" name="amount"'+
					' id="amount'+counter+'" value="'+book.amount+'" style="width:90%;height:90%;" required></td>'+

				'<td><button class="btn btn-danger btn-block" id="btnCancelProduct"'+
					' onclick="cancelProduct('+counter+');" style="width:90%;height:80%;">X</button></td>'+
			'</tr>';
	$('#codesTable').append(row);
}