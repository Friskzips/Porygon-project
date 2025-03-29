<?php
ob_start(); // Avvia l'output buffering
session_name("Porygon"); // Imposta il nome della sessione
session_start(); // Avvia la sessione
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione</title>
    <link rel="stylesheet" href="style3.css"> <!-- Collegamento al file CSS -->
</head>
<body>
    <div class="navbar"> <!-- Barra di navigazione -->
        <img src="img/logo.png" alt="Logo">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="calculate.php">Calcola</a></li>
        </ul>
        <div class="right">
            <a href="login.php">Accedi</a> <!-- Link alla pagina di login -->
        </div>
    </div>
    

    <div class="header">
        <h1>Registrati</h1><hr>   
    </div>
    <div id="form_login">
        <form method="POST"> <!-- Form per la registrazione -->
            <label for="fname">Username:</label>
            <input type="text" id="username" name="username" required> <!-- Campo per l'username -->
            
            <label for="lname">Password:</label>
            <input type="password" id="password" name="password" required> <!-- Campo per la password -->
            
            <input type="submit" name="submit" value="Registrati"> <!-- Bottone di registrazione -->
            <br>
            <a href="login.php">Hai già un account? Effettua l'accesso.</a> <!-- Link alla pagina di login -->
        </form> 
        <?php
        if(isset($_POST['submit'])){ // Controlla se il form è stato inviato

            // Apre il file contenente le credenziali del database
            $file = fopen("database_access/database_infos.csv", "r"); 
            if ($file !== false) { 
                $line = fgetcsv($file, 1000, ";"); // Legge la prima riga del file CSV
                if ($line !== false && count($line) >= 4) { // Controlla che la riga contenga almeno 4 elementi
                    $hostname_connect = $line[0];   // Host del database
                    $username_connect = $line[1];  // Username per la connessione
                    $password_connect = $line[2];  // Password per la connessione
                    $database_connect = $line[3];  // Nome del database
                } else {
                    echo "Il file contenente le informazioni del database, non è corretto"; // Messaggio di errore se il file è formattato male
                }
                fclose($file); // Chiude il file
            }

            // Connessione al database
            $con = mysqli_connect($hostname_connect, $username_connect, $password_connect, $database_connect);
            if (mysqli_connect_errno()) { // Controlla se la connessione è fallita
                echo "Tentativo di connessione fallito: " . mysqli_connect_error(); // Messaggio di errore
                exit(); // Termina lo script in caso di errore
            }

            $username = $_POST['username']; // Recupera l'username dal form
            $tohash = $_POST['password']; // Recupera la password dal form

            $password = password_hash($tohash, PASSWORD_BCRYPT); // Crittografa la password con BCRYPT

            // Verifica se l'username esiste già nel database
            $query = "SELECT * FROM Utenti WHERE username = '$username'";
            $result = mysqli_query($con, $query);

            $row = mysqli_fetch_assoc($result); // Recupera i dati dell'utente (se esiste)

            if($row){ // Se l'username esiste già
                echo "Username esistente"; // Messaggio di errore
            }else{ // Se l'username è disponibile
                $query = "INSERT INTO Utenti (username, password) VALUES ('$username', '$password');";
                $result = mysqli_query($con, $query); // Esegue la query per registrare l'utente
                
                // Avvia la sessione dell'utente appena registrato
                $_SESSION['logged'] = true;
                $_SESSION['username'] = $username;
            }
        }
    ?>
    </div>  

    <div class="footer"> <!-- Footer della pagina -->
        <p>© 2025 Impronta Digitale di CO2. Tutti i diritti riservati.</p>
    </div>
</body>
</html>
