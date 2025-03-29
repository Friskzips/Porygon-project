uid = 0;

function dragstartHandler(ev) 
{
    ev.dataTransfer.setData("button", ev.target.id);
    ev.target.setAttribute("dragging", true);
}

function deleteHandler(ev) 
{
    ev.preventDefault();
    
    // Recupera l'ID dell'elemento trascinato dal dataTransfer
    const data = ev.dataTransfer.getData("button");

    // Cerca l'elemento nel documento usando l'ID
    const elementToDelete = document.getElementById(data);

    // Se l'elemento esiste, lo rimuove
    if (elementToDelete && elementToDelete.getAttribute("cloned") == "true") {
        elementToDelete.remove();
        console.log("Elemento eliminato:", data);
    } else {
        console.log("Elemento non trovato o l'operazione che hai tentato di fare non è possibile");
    }

    
}
  
function dragoverHandler(ev) 
{
    ev.preventDefault();
    ev.target.setAttribute("dragging", false);
}
  
async function dropHandler(ev) 
{
    ev.preventDefault();
    const data = ev.dataTransfer.getData("button");
    console.info(data);

    element = document.getElementById(data);
    
    if (element && element.getAttribute("cloned") == null) 
    {
        let clone = element.cloneNode(true);
        clone.setAttribute("dragging", false);
        element.setAttribute("dragging", false);
        console.info(clone);
        ev.currentTarget.appendChild(clone);
        clone.setAttribute("cloned", "true");
        clone.id = "cloned"+uid;
        uid++;

        ev.dataTransfer.setData("", clone);
        
        console.info("Elemento creato: " + element.id);

        //Clona l'elemento poi lo aggiunge
        const formData = new FormData();
    var response = await fetch('get_stanza.php', { method: 'POST', body: formData });
    const dataResponse = await response.json();

        
        let stanze = dataResponse.stanzeUniche;
        
        let matDispo = dataResponse.matDispo;
        
        let matServ = dataResponse.matServ;


        let arrayDati = [];
            matDispo.forEach(row => {
                if(row[1]===element.id){
                let co2 = row[2] * row[3] * row[4] * row[7];
                arrayDati.push([element.id,co2]);
                }
            });
            matServ.forEach(row => {
                if(row[1]===element.id){
                    let co2 = row[2] * row[3] * row[6];
                arrayDati.push([element.id,co2]);
                }
            });

            console.info(arrayDati);

        aggiornaChart("idCanvas", arrayDati, ['rgba(204, 198, 75, 1)', 'rgba(0, 128, 0, 1)']);
    }
    else
    {
        console.log("Elemento non trovato o l'operazione che hai tentato di fare non è possibile");
    }

    ev.dataTransfer.setData("", data);

}

function aggiornaChart(id, dati, colori) {
    var ctx = document.getElementById(id).getContext('2d');
    
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



  