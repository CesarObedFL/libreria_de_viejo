function calculateTotal() {
	total = 0;
	var subtotal = [];
	for (var i = 1; i <= counter; i++) {
		price = $('#price'+i).val();
		amount = $('#amount'+i).val();
		discount = $('#discount'+i).val();
		if (discount > 20 || discount < 0) discount = 0;

		subtotal[i] = price * amount;
		total += subtotal[i] - (subtotal[i] * (discount/100));
	}
	$("#total").val(Math.abs(total.toFixed(2)));
}