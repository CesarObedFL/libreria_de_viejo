function cancelProduct(index) {
	if(confirm("Seguro de cancelar el libro "+index+" de la devolución?...")) {
		$('#row'+index).remove();
		reOrder();
		counter--;
		products.splice(index - 1,1);
		if(products.length < 1) 
			$('#btnAccept').prop('disabled','true');
	}
}

function reOrder() {
	var index = 0;
	$('#returnsTable tbody tr').each(function() {
		$(this).attr('id','row'+(++index));
		$(this).find('td').eq(1).find('input').attr('id','amount'+index);
		$(this).find('td').eq(1).find('input').attr('onblur','validateAmount('+index+');');
		$(this).find('td').eq(2).find('button').attr('onclick','cancelProduct('+index+');');
	});
}