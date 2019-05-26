function validateAmount(index) {
	var amount = $('#amount'+index).val();
	if (amount <= 0) {
		alert("La cantidad debe ser mayor a 0");
		$('#amount'+index).val('1');
	} else {
		object = jQuery.parseJSON(books[index-1]);
		object.amount = parseInt($('#amount'+index).val());
		books[index-1] = JSON.stringify(object);
	}
	calculateTotal();
}