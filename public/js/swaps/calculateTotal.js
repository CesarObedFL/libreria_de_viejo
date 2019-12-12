function calculateTotal() {
	var total = 0, i = 0;

	for (i = 0; i < outProducts.length; i++) {
		var product = jQuery.parseJSON(outProducts[i]);
		total += parseFloat(product.price) * parseFloat(product.amount);
	}
	
	for(i = 0; i < inProducts.length; i++){
		var product = jQuery.parseJSON(inProducts[i]);
		total -= parseFloat(product.price) * parseFloat(product.amount);
	}

	if (total > 0)
		$("#total").val(Math.abs(total.toFixed(2)));
	else
		$("#total").val(0);
}