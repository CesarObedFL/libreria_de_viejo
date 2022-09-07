function cancelProduct(index) {
	if(confirm("Seguro de cancelar el producto "+index+" de la venta?...")) {
		$('#row'+index).remove();
		reOrder();
		counter--;

		products.splice(index - 1,1);
		if(products.length < 1) 
			$('#btnAccept').prop('disabled', 'true');
	}
}

function reOrder() {
	var index = 0;
	$('#productsTable tbody tr').each(function() {
		$(this).attr('id','row'+(++index));
		$(this).find('td').eq(0).text(index);
		$(this).find('td').eq(3).find('input').attr('id', 'amount'+index);
		$(this).find('td').eq(3).find('input').attr('onblur', 'validateAmount('+index+');');
		$(this).find('td').eq(5).find('button').attr('onclick', 'cancelProduct('+index+');');
	});
}