const footer = document.getElementById("one")
const allStars = document.querySelectorAll(".fa-star");
const highlightedStars = [];
const rating = document.querySelector(".rating");
// variables du formulaire pour recuperer la note et l'envoyer en post
const form 		= document.querySelector("form")
const button 	= document.querySelector('button[type="submit"]')
const inputNote = document.querySelector('#note');
let buttonText  = button.textContent

const alert = document.querySelector(".alert")

init();

// initialiser le system
function init() {
  allStars.forEach((star) => {
    star.addEventListener("click", saveRating);
    star.addEventListener("mouseover", addCSS);
    star.addEventListener("mouseleave", removeCSS);
  });
  footer.style.display = "none";
  alert.style.display = 'none';
}

// sauvegarder la note de l'utilisateur
function saveRating(e) {
  removeEventListenersToAllStars();
  let note = e.target.dataset.star;
  rating.innerText = note
  // Inserons la valeur du vote dans l'input name = note input
  inputNote.value = note;
  // console.log('inputNote.value',inputNote.value)
  form.addEventListener("submit",sendForm)
}


function sendForm(event){

    event.preventDefault();

    button.disabled = true;
    button.textContent = 'Chargement...';

    const req = new XMLHttpRequest();
    const method = "POST";
    const url = "ajax/note.php";

    req.open(method,url,true)

    const data = new FormData(form)

    req.onreadystatechange = function(){

        if(this.readyState === 4){

            if(this.status === 200){ // si le seveur a cree un post en base

                // Mises a jour de dom
                let results = JSON.parse(this.responseText)

                form.querySelector('textarea').value = ""

                // on vide la valeur de l'input
                let inputs = document.querySelectorAll('input')
                // on vide la valeur de l'input
                for(let i = 0;i < inputs.length; i++ ){
                    inputs[i].value = ""
                }
                //on reactive le bouton
                button.disabled = true
                button.textContent = buttonText
                alert.style.display = 'block';

            } else{ 
                // console.log("Statut:",this.status);
                // //on reactive le bouton
                button.disabled = false
                button.textContent = buttonText
            }
        }
    }

    req.setRequestHeader('X-Request-With','xmlhttprequest')
    req.send(data)
}


// on enleve la possibiliter de noter une fois que l'on a deja note
function removeEventListenersToAllStars() {
  allStars.forEach((star) => {
    star.removeEventListener("click", saveRating);
    star.removeEventListener("mouseover", addCSS);
    star.removeEventListener("mouseleave", removeCSS);
  });
}

// ajouter la classe checked
function addCSS(e, css = "checked") {
  const overedStar = e.target;
  overedStar.classList.add(css);
  const previousSiblings = getPreviousSiblings(overedStar);
  // console.log("previousSiblings", previousSiblings);
  previousSiblings.forEach((elem) => elem.classList.add(css));
}

// enlever la classe checked
function removeCSS(e, css = "checked") {
  const overedStar = e.target;
  overedStar.classList.remove(css);
  const previousSiblings = getPreviousSiblings(overedStar);
  previousSiblings.forEach((elem) => elem.classList.remove(css));
}


// fontion pour recuperer tous les spans(freres) precedent au survol
function getPreviousSiblings(elem) {
  // console.log("elem.previousSibling", elem.previousSibling);
  let sibs = [];
  // les span ont un node type de 1
  const spanNodeType = 1;
  while ((elem = elem.previousSibling)) {
  	// on teste si c'est bien un span
    if (elem.nodeType === spanNodeType) {
      sibs = [elem, ...sibs];
    }
  }
  return sibs;
}


