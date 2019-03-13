$(document).ready(function () {
	$('.btn-addProduct').click(function (e) {
		e.preventDefault();
		add();
	});
});

var counter = 0;
total = 0;
subTotal = [];

function add() {
	var product = document.getElementById('product').value.split('_');

	var table = document.getElementById('products');
	var lastRow = table.rows.length;
	var row = table.insertRow(lastRow);

	(row.insertCell(0)).innerHTML = product[1]; // name
	(row.insertCell(1)).innerHTML = product[2]; // tips
	(row.insertCell(2)).innerHTML = '<input class="form-control" name="price" id="price" value="'+product[3]+'">'; // price
	(row.insertCell(3)).innerHTML = '<input class="form-control" type="number" name="amount" id="amount" value="0">'; 		// amount
	(row.insertCell(4)).innerHTML = '<input class="form-control" type="number" name="discount" id="discount" value="0">'; 		// discount
	(row.insertCell(5)).innerHTML = product[4]; // stock
	(row.insertCell(6)).innerHTML = '<button class="btn btn-danger btn-block btn-deleteProduct">X';

	return false;
}
//*/