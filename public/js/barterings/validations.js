function validateAmount(index) {
	var amount = $('#amount'+index).val();
	var stock = $('#stock'+index).val();
	if (amount <= 0 || amount > stock) {
		alert("La cantidad debe ser mayor a 0 y menor al stock ("+stock+") de ese producto...");
		$('#amount'+index).val('1');
		calculateTotal();
	}
}

function validateDiscount(index) {
	var discount = $('#discount'+index).val();
	if(discount < 0 || discount > 20) {
		alert("El descuento debe ser mayor a 0 y menor al 20%...");
		$('#discount'+index).val('0');
	}
}

function validatePay() {
	var total = $('#total').val();
	var pay = $('#pay').val();
	if(Math.round(total) > pay) {
		alert("El pago debe ser mayor al total...");
		$('#pay').val('');
		return false;
	} else return true;
}