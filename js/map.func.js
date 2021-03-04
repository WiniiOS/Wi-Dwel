const footer = document.getElementsByTagName("footer");

const resetMapButton = document.querySelector("#reset-map");
const backToMapButton = document.querySelector("#back-to-map");
const dreamsContainer = document.querySelector("#dreams-container");
let map,infoWindow;
let panorama;
let panoramaElement = document.querySelector("#panorama");

const data = [
    {
        id:1,
        description:"Yaounde",
        done:false,
        coordinates:{lat:3.86667,lng:11.5167}
    },
    {
        id:2,
        description:"Douala",
        done:false,
        coordinates:{lat:4.061536,lng:9.786072}
    },
    {
        id:3,
        description:"Buéa",
        done:false,
        coordinates:{lat:4.159302,lng:9.243536}
    },
    {
        id:4,
        description:"Bafoussam",
        done:false,
        coordinates:{lat:5.47775,lng:10.41759}
    },
    {
        id:5,
        description:"Bamenda",
        done:false,
        coordinates:{lat:4.86667,lng:11.5167}
    },
    {
        id:6,
        description:"Bertoua",
        done:false,
        coordinates:{lat:4.583331,lng:13.6833306} 
    },
    {
        id:7,
        description:"Maroua",
        done:false,
        coordinates:{lat:10.592529,lng:14.321009}
    },
    {
        id:8,
        description:"Ngaoundere",
        done:false,
        coordinates:{lat: 7.31667,lng:13.5833}
    },
    {
        id:9,
        description:"Ebolowa",
        done:false,
        coordinates:{lat:2.916663,lng:11.1499994}
    },
    {
        id:10,
        description:"Garoua",
        done:false,
        coordinates:{lat:9.30143,lng:13.39771}
    }
]


// Gestion de la MAP



// initiation de l'application
function init() {
    initMap();
    buildAllDreams();
}

// on ajoute l'init function au scope global
window.init = init;

// on cree un objet de type Map et streetView (panorama)
function initMap() {
    map = new google.maps.Map(document.getElementById('map'),{
        center:{lat:3.86667,lng:11.5167},zoom:3,streetViewControl: false
    }); 

    panorama = new google.maps.StreetViewPanorama(
        document.getElementById('panorama'), {
          position:{lat:3.86667,lng:11.5167},
          pov: {
            heading: 34,
            pitch: 10
        }
    });

    nextInitMap()

    // test
    map.setCenter({lat:7.365302,lng:12.343439});
    map.setZoom(7);


    // on relie la streetview a la map
    map.setStreetView(panorama);
    // 
    addMapListeners();
    // cachons la street view pour voir la map de base
    panoramaElement.style.display = "none";
    //bouton pour retourner a la map au cas ou on a affiché le panorama
    backToMapButton.style.display = "none";

}

function addMapListeners() {
    resetMapButton.addEventListener("click",resetMap);
    backToMapButton.addEventListener("click",backToMap);
}

function resetMap() {
    map.setZoom(7);
    map.setCenter({lat:7.365302,lng:12.343439});
    map.setMapTypeId("roadmap");
}

// on cache la streetview 
function backToMap() {
    panoramaElement.style.display = "none";
    resetMapButton.style.display = "block";
}


// gestion des reves!


function buildAllDreams() {
    // effacons tous les dreams pour eviter les doubles iterations
    while (dreamsContainer.lastChild) {
        dreamsContainer.removeChild(dreamsContainer.lastChild);
    }
    data.forEach(buildOneDream);
    addDreamsListeners();
}

// le forEach donne au parametre "dream" de buildOneDream chacun des objets du array data
function buildOneDream(dream) {
    const dreamElement = document.createElement("div");
    dreamElement.innerHTML = `
    <div class="card text-center" id="${dream.id}">
        <h4 title="cliquez sur Ma position pour visiter votre quartier! Puis zoomez!" class="text-dark card-header font-weight-bold">
            ${dream.description}
        </h4>
    </div>
    `;
    dreamsContainer.appendChild(dreamElement);
    addMarkerOnMap(dream);  //prend un reve et ajoute son markeur
}

// le parametre dream est un objet detache du data par forEach()
function addMarkerOnMap(dream) {
    const marker = new google.maps.Marker({
        position:dream.coordinates,
        icon: dream.done ? "assets/marker-done.png" : "assets/marker.png",
        map:map
    });

    marker.addListener('click', function() {
        zoomOn(marker.getPosition());
        console.log(marker.getPosition());
    });
}

// on fait un zoom sur la position cliqué
function zoomOn(position) {
    map.setZoom(15);
    map.setCenter(position);
    map.setMapTypeId("satellite");
}

function addDreamsListeners(){
    document.querySelectorAll(".button-visit").forEach(item => {
        item.addEventListener("click", event => {
            // lancons la  fonction visitDream sur l'identifiant de notre bouton visiter
            visitDream(item.parentElement.parentElement.getAttribute("id"));
        });
    });

    document.querySelectorAll(".button-action").forEach(item => {
        item.addEventListener("click", event => {
            // lancons la  fonction visitDream sur l'identifiant de notre bouton visiter
            toggleDreamDone(item.parentElement.parentElement.getAttribute("id"));
        });
    });
}

function visitDream(dreamId){
    // la seule chose dont on a besoin pour visiter notre reve 
    //c'est juste la position de notre dream sur la map
    let position = data.filter( item => item.id == dreamId)[0].coordinates;
    visitDreamOnMap(position);
}

function visitDreamOnMap(position) {
    panorama.setPosition(position);
    // la St view s'affiche only quand on clique sur le button
    panoramaElement.style.display = "block";
    backToMapButton.style.display = "block";
    resetMapButton.style.display = "none";
    
}



function toggleDreamDone(dreamId) {
    //on recupere un reve selon l'id
    let dream = data.filter( item => item.id == dreamId)[0];//elle renvoi une valeur du array data
    dream.done = !dream.done;
    //on raffraichi le map grace a buildAllDreams
    buildAllDreams();
}



// geolocation





// Note: This example requires that you consent to location sharing when
// prompted by your browser. If you see the error "The Geolocation service
// failed.", it means you probably did not give permission for the browser to
// locate you.
// let map, infoWindow;

function nextInitMap() {
  
  infoWindow = new google.maps.InfoWindow();
  const locationButton = document.createElement("button");
  locationButton.textContent = "Ma position";
//   locationButton.classList.add('btn btn-danger');
  locationButton.classList.add("custom-map-control-button");
  map.controls[google.maps.ControlPosition.BOTTOM_CENTER].push(locationButton);
  locationButton.addEventListener("click", () => {
    // Try HTML5 geolocation.
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        (position) => {
          const pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude,
          };
          infoWindow.setPosition(pos);
          infoWindow.setContent("Vous etes ici!");
          infoWindow.open(map);
          map.setCenter(pos);
        },
        () => {
          handleLocationError(true, infoWindow, map.getCenter());
        }
      );
    } else {
      // Browser doesn't support Geolocation
      handleLocationError(false, infoWindow, map.getCenter());
    }
  });
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(
    browserHasGeolocation
      ? "Error: Le service de geolocalisation a echoue."
      : "Error: Votre navigateur ne supporte pas la geolocation."
  );
  infoWindow.open(map);
}