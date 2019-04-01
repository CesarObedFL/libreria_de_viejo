function validateAmount() {
	var amount = $("#amount").val();
	var stock = $("#stock").val();
	if (amount < 0 || amount > stock) {
		alert("La cantidad debe ser menor al stock de ese producto...");
		$("#amount").val('1');
	}
}