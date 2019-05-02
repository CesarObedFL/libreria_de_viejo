$(document).ready(function() {
	const INTEGER = 1, REAL = 2, ISBN = 3;
	$('#stock').keypress(function(event) { return typeNumber(event,INTEGER); });
	$('#amount').keypress(function(event) { return typeNumber(event,INTEGER); });
    $('#phone').keypress(function(event) { return typeNumber(event,INTEGER); });
	$('#pay').keypress(function(event) { return typeNumber(event,REAL);	});
	$('#price').keypress(function(event) { return typeNumber(event,REAL); });
	$('#isbn').keypress(function(event) { return typeNumber(event,ISBN); });
});

function typeNumber(event, type) {
    const BACKSPACE = 8, DOT = 46, ADD = 43, SUBSTRACT = 45;
    key = event.keyCode || event.which;
    KEY = String.fromCharCode(key).toLowerCase();
    numbers = "0123456789";
    specials = [BACKSPACE];

    if (type == 2) // reals
    	specials = [BACKSPACE,DOT];
	else if(type == 3) // isbn's
		numbers += "x";

    specialKey = false
    for(var i in specials) {
        if(key == specials[i]){
            specialKey = true;
            break;
        }
    }
    //console.log(numbers+"  "+specials);
    if(numbers.indexOf(KEY)==-1 && !specialKey)// && (key == ADD || key == SUBSTRACT))
        return false;
}