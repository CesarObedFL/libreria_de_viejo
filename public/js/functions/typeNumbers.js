function typeRealNumber(event) {
    const BACKSPACE = 8;
    const DOT = 46;
    
    key = event.keyCode || event.which;
    KEY = String.fromCharCode(key).toLowerCase();
    numbers = "0123456789x";
    specials = [BACKSPACE,DOT];
    specialKey = false
    for(var i in specials){
        if(key == specials[i]){
            specialKey = true;
            break;
        }
    }
    
    if(numbers.indexOf(KEY)==-1 && !specialKey)
        return false;
}
