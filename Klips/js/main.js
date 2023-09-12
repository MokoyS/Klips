/* Navbar */

const bars = document.querySelector(".navbar .bars") 
const navLinks = document.querySelector(".nav-links") 

bars.addEventListener('click',()=>{
navLinks.classList.toggle('mobile-menu')
})

/* popup */

let popup = document.getElementById("popup")

function openPopup () {
    popup.classList.add("open-popup")
}

function closePopup () {
    popup.classList.remove("open-popup")
}


/* Sounds */

const audio = new Audio();
audio.src = "./sound.mp3"; 

/* popup delete */

let del = document.getElementById("popupsup")

document.querySelectorAll('.sup').forEach(btn => {
    btn.addEventListener('click', (e) => {
        document.querySelector('.yes').href = `delete.php?id=${e.target.attributes.id.value.split('-')[1]}`
        del.classList.add("open-popup")

    })
})

document.querySelector('.no').addEventListener('click', () => {
    del.classList.remove("open-popup")

})

function closePopupsup () {
    del.classList.remove("open-popup")
}

let allArticles = document.querySelectorAll('.postall')

// Fonction pour filtrer les éléments en fonction de la classe sélectionnée
function filtre() {
    // Récupérer la valeur sélectionnée dans le menu déroulant
    var SelectValue = document.getElementById("jeux").value;
    let selectedTag = document.querySelectorAll("." + SelectValue)
    console.log(selectedTag)
    console.log(SelectValue);
    allArticles.forEach(article => {
        article.classList.remove('postall')
        article.classList.add('none')
    });
    selectedTag.forEach(tag => {
        tag.classList.remove('none')
        tag.classList.add('postall')
    });



}
  
  // Écouter les changements dans le menu déroulant
document.getElementById("jeux").addEventListener("change", filtre);


const btn = document.querySelector('.up-bnt');

btn.addEventListener('click', () => {
    window.scrollTo({
        top:0,
        left:0,
        behavior : "smooth"
    })
} )

