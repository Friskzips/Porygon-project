document.addEventListener("DOMContentLoaded", function () {
    function creaGrafico(id, imgSrc, dati, colori) {
        var ctx = document.getElementById(id).getContext('2d');
    
        let img = new Image();
        img.src = imgSrc;
    
        let plugins = [];  // Array per i plugin, inizialmente vuoto
    
        // Se imgSrc non è vuoto, aggiungi il plugin per l'immagine
        if (imgSrc !== '') {
            plugins.push({
                id: 'centerImage',
                beforeDraw: function (chart) {
                    var width = chart.width,
                        height = chart.height,
                        ctx = chart.ctx;
    
                    ctx.restore();
    
                    var imgSize = Math.min(width, height) / 3; // Imposta la dimensione dell'immagine
                    var x = (width - imgSize) / 2;
                    var y = (height - imgSize) / 2;
    
                    ctx.drawImage(img, x, y, imgSize, imgSize);
                    ctx.save();
                }
            });
        }
    
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Utente', 'Azienda'],
                datasets: [{
                    data: dati,
                    backgroundColor: colori,
                    borderColor: colori.map(c => c.replace('0.5', '1')), 
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    tooltip: {
                        enabled: true
                    }
                }
            },
            plugins: plugins  // Aggiungi i plugin condizionali
        });
    }
    

    // Crea i grafici con le immagini al centro
    creaGrafico('Ita', 'img/Italia.png', [40, 60], ['rgba(128, 128, 128, 0.5)', 'rgba(0, 255, 255, 0.5)']);
    creaGrafico('Euro', 'img/europa.png', [30, 70], ['rgba(128, 128, 128, 0.5)', 'rgba(0, 255, 255, 0.5)']);
    creaGrafico('Mondo', 'img/mondo.png', [20, 80], ['rgba(128, 128, 128, 0.5)', 'rgba(0, 255, 255, 0.5)']);
});

// Funzione per mostrare/nascondere la navbar
function visualizza_nav() {
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



