async function stampa() {

    const formData = new FormData();
    var response = await fetch('get_stanza.php', { method: 'POST', body: formData });
    const data = await response.json();

    let stanze = data.stanzeUniche;

    let matDispo = data.matDispo;

    let matServ = data.matServ;

    let container = document.querySelector(".container");
 
    
    /*stanze.forEach(sala => {
        let stanza = document.createElement("div");
        stanza.setAttribute("class", "stanze");
        stanza.textContent = sala;

        let canvas = document.createElement("canvas");

        canvas.width = 180;
        canvas.height = 180;
        
        stanza.appendChild(canvas);

        container.appendChild(stanza);
        
        creaDonutStanza(canvas, [40, 30], ['rgba(204, 198, 75, 1)', 'rgba(0, 128, 0, 1)']);
        
    });*/

    stanze.forEach(sala => {
        let totD = 0;
        let totS = 0;
        matDispo.forEach(row => {
            if(row[0] === sala){
                console.info(row[0]);
                let co2 = row[2] * row[3] * row[4] * row[7];
                console.info(co2);
                totD= totD+ co2;  
            }
             
          });
        matServ.forEach(row => {
            if(row[0] === sala){
                console.info(row[0]);
            let co2 = row[2] * row[3] * row[6];
            totS= totS+ co2;  
            }
        });
        // Crea il contenitore della stanza
        let stanza = document.createElement("div");
        stanza.setAttribute("class", "stanze");
    
        // Crea la tabella
        let table = document.createElement("table");
        table.setAttribute("class", "table");
    
        // Crea la prima riga con il nome della stanza
        let row1 = table.insertRow();
        let cell1 = row1.insertCell();
        cell1.colSpan = 2;  // Fa in modo che occupi due colonne
        cell1.textContent = sala; // Nome della stanza
        cell1.classList.add("center-text"); // Aggiungi la classe per centrare il testo
    
        // Crea la seconda riga con il grafico
        let row2 = table.insertRow();
        let cell2 = row2.insertCell();
        let canvas = document.createElement("canvas");
        canvas.width = 180;
        canvas.height = 180;
        cell2.appendChild(canvas); // Aggiungi il canvas alla cella
        creaDonutStanza(canvas, [totD, totS], ['rgba(0, 255, 255, 0.5)', 'rgba(111, 88, 157, 0.5)']);
    
        // Crea la terza riga con i pulsanti
        let row3 = table.insertRow();
        let cell3 = row3.insertCell();
        let button1 = document.createElement("button");
        button1.textContent = "Entra";
        button1.classList.add("entra");
        let button2 = document.createElement("button");
        button2.textContent = "Elimina";
        button2.classList.add("elimina");
        cell3.appendChild(button1);
        cell3.appendChild(button2);
        cell3.classList.add("center-text"); // Aggiungi la classe per centrare il testo
    
        // Aggiungi la tabella alla stanza
        stanza.appendChild(table);
    
        // Aggiungi la stanza al contenitore principale
        container.appendChild(stanza);
    });
    
    
    

    let stanzaV = document.createElement("div");
    stanzaV.setAttribute("class", "stanzaV");
    
    let button = document.createElement("button");
    button.setAttribute("class", "but");
    button.textContent = "+";

    stanzaV.appendChild(button);
    container.appendChild(stanzaV);
}
function creaDonutStanza(canvas, dati, colori) {
    var ctx = canvas.getContext('2d');
    
    let plugins = [];
    
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Dispositivi', 'Servizi'],
            datasets: [{
                data: dati,
                backgroundColor: colori,
                borderColor: colori.map(c => c.replace('0.5', '1')), 
                borderWidth: 1
            }]
        },
        options: {
            responsive: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        font: {
                            size: 8, 
                        },
                        usePointStyle: true,
                        padding: 8, 
                    }
                },
                tooltip: {
                    enabled: true
                },
            }
        },
        plugins: plugins
    });
}


