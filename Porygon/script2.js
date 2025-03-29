// Funzione per mostrare/nascondere la navbar
function visualizza_nav2() {
    const navbar = document.querySelector('.navbar');
    // Controlla se la navbar è attualmente visibile
    if (navbar.style.display === "none" || navbar.style.display === "") {
        navbar.style.display = "flex"; // Mostra la navbar
    } else {
        navbar.style.display = "none"; // Nascondi la navbar
    }
}

// Aggiungi un evento al caricamento della pagina
window.onload = function() {
    // Nascondi la navbar inizialmente
    document.querySelector('.navbar').style.display = "none";
};


function mostra() {
    // Get the div to show
    const divToShow = document.getElementById('mostra');
    
    // Get the body element to apply the dark background
    const bodyContent = document.querySelector('body');
    
    // Create and append the overlay to darken the background
    const overlay = document.createElement('div');
    overlay.classList.add('overlay');
    bodyContent.appendChild(overlay);

    // Show the div by changing its display property
    divToShow.style.display = 'block';
    
    // Darken the background by adding a filter to the body
    bodyContent.classList.add('darker');

    // Close the div when the overlay is clicked
    overlay.addEventListener('click', function() {
        divToShow.style.display = 'none';
        bodyContent.classList.remove('darker');
        overlay.remove();
    });
}
