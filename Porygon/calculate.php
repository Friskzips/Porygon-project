<?php

$file = fopen("database_access/database_infos.csv", "r"); 
if ($file !== false) {
    $line = fgetcsv($file, 1000, ";"); 
    if ($line !== false && count($line) >= 4) { 
        $hostname_connect = $line[0];   
        $username_connect = $line[1];  
        $password_connect = $line[2];   
        $database_connect = $line[3];   
    } else {
        echo "Il file contenente le informazioni del database, non è corretto";
        exit();
    }
    fclose($file);
}

$con = mysqli_connect($hostname_connect, $username_connect, $password_connect, $database_connect);
if (mysqli_connect_errno()) {
    echo "Tentativo di connessione fallito: " . mysqli_connect_error();
    exit();
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impronta Digitale di CO2</title>
    <link rel="stylesheet" href="style2.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="scriptDragAndDrop.js"></script>   
    <script src="script2.js"></script> 
</head>
<body>
    <div class="navbar">
        <img src="img/logo_finale.png" alt="Logo">
        <div class="left">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="calculate.php">Calcola</a></li>
            </ul>
        </div>
        <div class="right">
            <a href="login.php">Accedi</a>
        </div>
    </div>

    <div class="header">
        <h1>Calcola la tua impronta digitale di CO2</h1>
        <button onclick="visualizza_nav2()" class="toggle-nav">Mostra barra informazioni</button> 
    </div>

    <div class="container">
        <div class="pannello_di_sinistra">

            
            <h2>Selezione di prodotti e servizi</h2>
            <div class="options" ondrop="deleteHandler(event)" ondragover="dragoverHandler(event)">
            <?php
             $query = "SELECT *,Servizi.nome_servizio AS nome FROM Dati JOIN Servizi ON Servizi.tipo_servizio = Dati.tipo";
             $result = mysqli_query($con, $query);
             while ($row = $result->fetch_assoc()) {
             ?>
                 <button onclick="mostra()" class="draggableButton" draggable="true" ondragstart="dragstartHandler(event)" id="<?php echo $row['nome']; ?>">
                     <?php echo $row['nome']; ?>
                 </button>
             <?php  
                 $i++;
             }
                $query = "SELECT * FROM Dati";
                $result = mysqli_query($con, $query);
                while ($row = $result->fetch_assoc()) {
                ?>
                    <button onclick="mostra()" class="draggableButton" draggable="true" ondragstart="dragstartHandler(event)" id="<?php echo $row['tipo']; ?>">
                        <?php echo $row['tipo']; ?>
                    </button>
                <?php  
                    $i++;
                }
               
                ?>
            </div>
        </div>

        <div class="pannello_grafico">
            <h2>La mia impronta digitale di carbonio</h2>
            <div class="inserted" ondrop="dropHandler(event)" ondragover="dragoverHandler(event)">
            </div>
        </div>

        <div class="pannello_impronta">
            <h2>La tua impronta</h2>

            <div class="grafico">
                <canvas id="idCanvas" width="400" height="400" aria-label="La tua impronta"></canvas>
            </div>
            
            </div>
        </div>
       


    </div>

    <div id="mostra" class="modifica"></div>
    <div class="footer">
        <p>© 2025 Impronta Digitale di CO2. Tutti i diritti riservati.</p>
    </div>
    
</body>
</html>

<?php
$conn->close();
?>
