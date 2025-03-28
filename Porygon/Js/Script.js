document.addEventListener("DOMContentLoaded", function () {
    function creaGrafico(id, imgSrc, dati, colori) {
        var ctx = document.getElementById(id).getContext('2d');

        let img = new Image();
        img.src = imgSrc;

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
            plugins: [{
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
            }]
        });
    }

    // Crea i grafici con le immagini al centro
    creaGrafico('Ita', 'Img/italia.png', [40, 60], ['rgba(128, 128, 128, 0.5)', 'rgba(0, 128, 0, 0.5)']);
    creaGrafico('Euro', 'Img/Europa.png', [30, 70], ['rgba(128, 128, 128, 0.5)', 'rgba(0, 128, 0, 0.5)']);
    creaGrafico('Mondo', 'Img/Mondo.png', [20, 80], ['rgba(128, 128, 128, 0.5)', 'rgba(0, 128, 0, 0.5)']);
});




