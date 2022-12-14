function cancelProduct(index, type) {
	if(confirm("Seguro de cancelar el producto "+index+" del trueque?...")) {
		switch(type) {
			case 1: //
				$('#outrow'+index).remove();
				reOrder('outProductsTable','out',type);
				outCounter--;
				outProducts.splice(index - 1,1);
				break;
			case 2: // 
				$('#inrow'+index).remove();
				reOrder('inProductsTable','in',type);
				inCounter--;
				inProducts.splice(index - 1,1);
				break;
			default: alert('operación invalida...'); break;
		}
		calculateTotal();
	}
} 

function reOrder(table,id,type) {
	var index = 0;
	$('#'+table+' tbody tr').each(function() {
		$(this).attr('id',id+'row'+(++index));
		$(this).find('td').eq(0).text(index);
		
		if(id == 'out') {
			$(this).find('td').eq(3).find('input').attr('id', 'price'+index);
			$(this).find('td').eq(3).find('input').attr('onchange','setPrice(\'out\','+index+');');
			$(this).find('td').eq(4).find('input').attr('id', 'amount'+index);
			$(this).find('td').eq(4).find('input').attr('onchange', 'setAmount(\'out\','+index+');'); 
			$(this).find('td').eq(4).find('input').attr('onblur', 'validateAmount('+index+');');
			$(this).find('td').eq(5).find('input').attr('id', 'stock'+index);

		} else { // in
			$(this).find('td').eq(1).find('input').attr('onblur', 'setTitle('+index+');');
			$(this).find('td').eq(3).find('input').attr('id', 'in_price'+index);
			$(this).find('td').eq(3).find('input').attr('onchange','setPrice(\'in\','+index+');');
			$(this).find('td').eq(4).find('input').attr('id', 'in_amount'+index);
			$(this).find('td').eq(4).find('input').attr('onchange', 'setAmount(\'in\','+index+');'); 
		}
		$(this).find('td:last-child').find('button').attr('onclick', 'cancelProduct('+index+','+type+');');
	});
}