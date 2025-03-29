<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impronta Digitale di CO2 - Home</title>
    <link rel="stylesheet" href="style.css">  
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="script.js"></script>   
</head>
<body>

    <div class="navbar" role="navigation">
        <img src="img/logo_finale.png" alt="Logo del sito Impronta Digitale di CO2" aria-label="Logo">
        <div class="left">
            
            <ul>
                <li><a href="index.php" tabindex="1">Home</a></li>
                <li><a href="calculate.php" tabindex="2">Calcola</a></li>
                <li><a href="stanze.html" tabindex="3">Stanza personale</a></li>
            </ul>   
        </div>
        <div class="right">
            <a href="login.php" tabindex="4">Accedi</a>
        </div>
    </div>

    <header class="header">
        <button onclick="visualizza_nav()" class="toggle-nav" id="mostra" aria-expanded="false" aria-controls="info-bar">Mostra barra informazioni</button>
    </header>

    <div class="container">
        <section class="welcome">
            <h2>Benvenuto nel nostro sito!</h2>
            <p>Scopri come calcolare la tua impronta digitale di carbonio e come ridurla. Qui troverai informazioni sui prodotti e servizi che consumano energia e contribuiscono alle emissioni di CO2.</p>
            <p>Inizia ora il tuo viaggio verso una vita più sostenibile!</p><br><br>
            <a href="calculate.php" class="bottone_calcola" role="button" tabindex="5">Calcola la tua impronta</a>
        </section>
    </div>

    <section class="informazioni">
        <h2>Green computing: la nuova consapevolezza dell’Informatica verde</h2>
        <p>Nel 2018 il consumo energetico dei data center nell’UE è stato di 76,8 TWh, secondo uno studio della Commissione europea. Questo consumo dovrebbe salire a 98,52 TWh entro il 2030, con un aumento del 28%. Sempre nel 2018 i data center edge hanno rappresentato il 2% dell’energia utilizzata dai data center. Questa quota dovrebbe salire al 12% entro il 2025.</p>

        <h3>Come risparmiare energia con un corretto uso del PC e del monitor</h3>
        <p>Un tipico computer da ufficio acceso per 9 ore al giorno arriva a consumare fino a 175 kWh in un anno. Impostando l’opzione di risparmio energetico il consumo scende del 37%, con un risparmio di anidride carbonica (CO2) emessa in atmosfera di circa 49 kg!</p>

        <h3>Internet e CO2: lo streaming inquina quanto guidare un'auto?</h3>
        <p>Parlare di tonnellate di CO2 emesse, di chilowattora per l'elettricità, di metri cubi per il gas, di litri di benzina e di cavalli per le automobili crea confusione in molti, compreso chi lavora in ambito accademico. La maggior parte di noi non è in grado di dire quanta energia utilizziamo quotidianamente, né quale sia il livello di emissioni che le nostre attività provocano.</p>

        <p>Tenendo presente questo, proviamo a stimare l'uso di Internet nelle stesse unità di misura. Quello che cerchiamo ora è la quantità di energia per una certa quantità di dati trasferiti, espressa in gigabyte (GB).</p>

        <p>Sembra che un valore di 1 kWh per GB possa essere un'approssimazione ragionevole dell'attuale costo energetico dei dati. Utilizzando questa stima, possiamo ora confrontare più facilmente il consumo energetico dei dati con quello di altre attività umane.</p>

        <p>I consumi stanno aumentando. La prova di ciò è che da diversi anni il consumo energetico annuo delle infrastrutture delle tecnologie dell'informazione e della comunicazione è costantemente di almeno 2.000 TWh, pari al 5% dell'utilizzo globale di elettricità.</p>
    </section>

    <section class="informazioni2">
         <p>Ecco alcuni esempi di emissioni derivate da un utente e da un'azienda nei vari territori.</p>
    </section>

    <main>
        <div class="grafici-container">
            <div class="grafico">
                <canvas id="Ita" width="400" height="400" aria-label="Grafico sull'impronta di CO2 in Italia"></canvas>
            </div>
            <div class="grafico">
                <canvas id="Euro" width="400" height="200" aria-label="Grafico sull'impronta di CO2 in Europa"></canvas>
            </div>
            <div class="grafico">
                <canvas id="Mondo" width="400" height="200" aria-label="Grafico sull'impronta di CO2 globale"></canvas>
            </div>
        </div>
    </main>

    <footer class="footer">
        <p>© 2025 Impronta Digitale di CO<sub>2</sub>. Tutti i diritti riservati.</p>
    </footer>
    
</body>
</html>
