function validateAmount(index) {
	var amount = $('#amount'+index).val();
	var stock = $('#stock'+index).val();
	if (amount <= 0 || amount > stock) {
		alert("La cantidad debe ser mayor a 0 y menor al stock ("+stock+") de ese producto...");
		$('#amount'+index).val('1');
	} else {
		object = JSON.parse(products[index-1]);
		object.amount = parseInt($('#amount'+index).val());
		products[index-1] = JSON.stringify(object);
	}
}