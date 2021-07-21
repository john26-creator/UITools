//alert ("test");
const items = document.querySelectorAll('.slider div');
const nbSlides = items.length;
const suivant = document.querySelector('.right');
const precedent = document.querySelector('.left');
const modal = document.getElementById('modal');
let imageClicked = false;


let count = 0;

function slideSuivante (event) {
	event.preventDefault();
	items[count].classList.remove('active');
	if (count < nbSlides -1) {
		count++;
	} 
	else {
		count = 0;
	}

	items [count].classList.add('active');
	console.log(count);
}

suivant.addEventListener('click', slideSuivante);

function slidePrecedente (event) {
	event.preventDefault();
	items[count].classList.remove('active');
	if (count > 0) {
		count--;
	} 
	else {
		count = nbSlides - 1;
	}

	items [count].classList.add('active');
	console.log(count);
}

precedent.addEventListener('click', slidePrecedente);

const imgs = document.querySelectorAll('img');

function setImgListener (img) {
	img.addEventListener("click", function (event) {
		event.preventDefault();
		document.getElementById("modal").classList.toggle("active");
		imageClicked = true;
	})
}

imgs.forEach(element => setImgListener(element));

window.addEventListener('click', function(e){   
  if (!modal.contains(e.target) && ! imageClicked && modal.classList.contains ("active")){
  	document.getElementById("modal").classList.toggle("active");
  }
  imageClicked = false;
});