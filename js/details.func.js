// Systeme d'ajout en favoris
const post_id_owner = document.querySelector(".like-section")
const user_id_owner = post_id_owner.children[0] //like button

// const followBtn = document.querySelector(".theOne");
const followBtn = document.querySelector(".second");


init()

function init(){

    const footer = document.getElementById("one")
    footer.innerHTML = ""
    // on ajoute un ecouteur de click sur le bouton
    user_id_owner.addEventListener("click",send_favori)
    followBtn.addEventListener("click",follow)
}


function send_favori(e){
    
    e.preventDefault()
    // recuperation de l'identifiant du post et celui du curent user!
    const post_id = post_id_owner.getAttribute('id')
    const user_id = user_id_owner.getAttribute('id')

    console.log(post_id);
    console.log(user_id);

    const req = new XMLHttpRequest();
    const method = "POST";
    const url = "ajax/add_favori.php";
    req.open(method,url,true)

    const data = new FormData()
    data.append('article_id', post_id)
    data.append('user_id', user_id)

    req.onreadystatechange = function(){
        if(this.readyState === 4){
            if(this.status === 200){ // si le seveur a cree un post en base
                // let results = JSON.parse(this.responseText)
                // on rend rouge le bouton like
                user_id_owner.classList = "bi bi-heart-fill text-danger"
                //on desactive le bouton like
                user_id_owner.removeEventListener("click", send_favori)
            } else{
                console.log("Statut:",this.status);
            }
        }
    }

    req.setRequestHeader('X-Request-With','xmlhttprequest')
    req.send(data)
}


function follow(e){

    // followed id et id du follower
    const followed_id = this.getAttribute('id') //id du vendeur suivi
    const follower_id = e.target.dataset.follower //id du suiveur

    const req = new XMLHttpRequest();
    const method = "POST";
    const url = "ajax/follow.php";
    req.open(method,url,true)

    const data = new FormData()
    data.append('id_follower', follower_id)
    data.append('id_followed', followed_id)

    req.onreadystatechange = function(){
        if(this.readyState === 4){
            if(this.status === 200){
                // let results = JSON.parse(this.responseText)
                // traitement du DOM
                followBtn.textContent = "Abonné";
                followBtn.classList = "btn followed btn-info";
                this.removeEventListener("click", follow)
            } else{
                console.log("Statut:",this.status);
            }
        }
    }

    req.setRequestHeader('X-Request-With','xmlhttprequest')
    req.send(data)
}



