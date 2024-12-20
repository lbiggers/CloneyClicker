var counter = document.getElementById('counter');
var save = document.getElementById('saveScore');
var score = parseInt(counter.innerText);

function upScore(){
	score++;
	counter.innerHTML = score;
	save.value = score;
}