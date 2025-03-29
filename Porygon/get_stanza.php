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

$query = "SELECT Stanza.nome_stanza, Servizi.nome_servizio, Servizi.ore_utilizzo, Servizi.data_inizio, Dati.tipo, Dati.watt_h, Dati.kg_co2
            FROM Dati
            JOIN Servizi ON Servizi.tipo_servizio = Dati.tipo
            JOIN Stanza ON Stanza.id_stanza = Servizi.id_stanza
            JOIN Utenti ON Utenti.id_utente = Stanza.id_utente;";
$resultServizi = mysqli_query($con, $query);

$stanza = [];
$matServ = [];

while ($row = mysqli_fetch_assoc($resultServizi)) {
    $stanza[] = $row['nome_stanza'];
    $oggi = strtotime(date("Y-m-d"));
    $dataInizio = strtotime($row['data_inizio']);
    $differenzaGiorniServ = floor(($oggi - $dataInizio) / (60 * 60 * 24));

    $matServ[] = [
        $row['nome_stanza'],
        $row['nome_servizio'],
        $row['ore_utilizzo'],
        $differenzaGiorniServ,
        $row['tipo_servizio'],
        $row['watt_h'],
        $row['kg_co2']
    ];
}


$query = "SELECT Stanza.nome_stanza, Dispositivi.nome_disp, Dispositivi.num_disp, Dispositivi.tempo_uso, Dispositivi.durata_yy, Dati.tipo, Dati.watt_h, Dati.kg_co2
            FROM Dati
            JOIN Dispositivi ON Dispositivi.tipo_disp = Dati.tipo
            JOIN Stanza ON Stanza.id_stanza = Dispositivi.id_stanza
            JOIN Utenti ON Utenti.id_utente = Stanza.id_utente;";
$resultDispositivi = mysqli_query($con, $query);

$matDispo = [];

while ($row = mysqli_fetch_assoc($resultDispositivi)) {
    $stanza[] = $row['nome_stanza'];
    $oggi = strtotime(date("Y-m-d"));
    $dataInizio = strtotime($row['durata_yy']);
    $differenzaGiorniDisp = floor(($oggi - $dataInizio) / (60 * 60 * 24));
    
    $matDispo[] = [
        $row['nome_stanza'],
        $row['nome_disp'],
        $row['num_disp'],
        $row['tempo_uso'],
        $differenzaGiorniDisp,
        $row['tipo_dispositivo'],
        $row['watt_h'],
        $row['kg_co2']
    ];
}

$stanzeUniche = array_values(array_unique($stanza));

header("Content-Type: application/json");

$response = array(
    'matDispo' => $matDispo,
    'matServ' => $matServ,
    'stanzeUniche' => $stanzeUniche
);  

echo json_encode($response);

mysqli_close($con);
?>
