<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style3.css">
</head>
<body>
    <div class="navbar">
        <img src="img/logo_finale.png" alt="Logo">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="calculate.php">Calcola</a></li>
        </ul>
        <div class="right">
            <a href="login.php">Accedi</a>
        </div>
    </div>
    

    <div class="header">
        <h1>Effettua il Login</h1><hr>   
    </div>
    <div id="form_login">
        <form method="POST">
            <label for="fname">Username:</label>
            <input type="text" id="fname" name="fname" required>
            
            <label for="lname">Password:</label>
            <input type="password" id="lname" name="lname" required>
            
            <input type="submit" value="Login">
            <br>
            <a href="register.php">Non hai un Account? Registrati qui.</a>
        </form> 
    </div>
    <div class="footer">
        <p>© 2025 Impronta Digitale di CO2. Tutti i diritti riservati.</p>
    </div>
</body>
</html>