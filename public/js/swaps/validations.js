function validateAmount(index) {
	var amount = $('#amount'+index).val();
	var stock = $('#stock'+index).val();
	if (amount <= 0 || amount > stock) {
		alert("La cantidad debe ser mayor a 0 y menor al stock ("+stock+") de ese producto...");
		$('#amount'+index).val('1');
	} else {
		object = JSON.parse(outProducts[index-1]);
		object.amount = parseInt($('#amount'+index).val());
		outProducts[index-1] = JSON.stringify(object);
	}
	calculateTotal();
}

function validatePay() {
	var total = $('#total').val();
	var payment = $('#payment').val();
	if(Math.round(total) > payment) {
		alert("El pago debe ser mayor al total...");
		$('#payment').val('');
		return false; 
	} else return true;
}

function setTitle(index) {
	var product = JSON.parse(inProducts[(index-1)]);
	product.title = $('#title'+index).val();
	inProducts[(index-1)] = JSON.stringify(product);

}

function setPrice(type, index) {
	switch(type) {
		case 'out':
			var product = JSON.parse(outProducts[(index-1)]);
			product.price = $('#price'+index).val();
			outProducts[(index-1)] = JSON.stringify(product);
			break;
		case 'in':
			var product = JSON.parse(inProducts[(index-1)]);
			product.price = $('#in_price'+index).val();
			inProducts[(index-1)] = JSON.stringify(product);
			break;
	}
	
}

function setAmount(type, index) {
	switch(type) {
		case 'out':
			var product = JSON.parse(outProducts[(index-1)]);
			product.amount = $('#amount'+index).val();
			outProducts[(index-1)] = JSON.stringify(product);
			break;
		case 'in': 
			var product = JSON.parse(inProducts[(index-1)]);
			product.amount = $('#in_amount'+index).val();
			inProducts[(index-1)] = JSON.stringify(product);
			break;
	}
	
}