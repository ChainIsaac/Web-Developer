
// Meddelande text kvar.

const message = document.getElementById('message');
const counter = document.getElementById('counter');
message.onkeyup = function (){
    counter.innerHTML = "Tecken kvar: " + (500 - message.value.length );
}