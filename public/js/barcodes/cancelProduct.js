function cancelProduct(index) {
	if(confirm("Seguro de cancelar el código "+index+"?...")) {
		$('#row'+index).remove();
		reOrder();
		counter--;
		books.splice(index - 1,1);
	}
}

function reOrder() {
	var index = 0;
	$('#codesTable tbody tr').each(function() {
		$(this).attr('id','row'+(++index));
		$(this).find('td').eq(0).text(index);
		$(this).find('td').eq(3).find('input').attr('id','amount'+index);
		$(this).find('td').eq(4).find('button').attr('onclick','cancelProduct('+index+');');
	});
}