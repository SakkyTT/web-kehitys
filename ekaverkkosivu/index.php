<?php
session_start();

// PHP:n tarkoitus on siirtää dataa käyttäjältä palvelimelle
// ja palvelimelta käyttäjälle.
// Lisäksi kaikenlainen datan käsittely.
// 

sleep(1);


// Siirretään käyttäjä pois, jos ei ole kirjautunut
if(isset($_SESSION["username"]) == true){
    header("Location: memberArea.php");
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- form määrittää minne ja miten data (get/post) lähetetään -->
    <!-- Lisää formiin salasana input ja näytä se sivulla checkLogin. -->
    <!-- Kokeile myös saada salasan piilotettua kun sitä kirjoitetaan. -->
    <?php
    // Kirjoitetaan virhe ilmoitus, jos kirjautumisessa oli virhe
        if(isset($_GET["error"])){ // Tarkistetaan onko avain (muuttuja) olemassa, ennen kuin sitä käytetään.
            if($_GET["error"] == "login"){ // Saadaan virhe, jos "error"-avain ei ole olemassa
                echo "<p>Käyttäjätunnus ja salasana eivät täsmää!</p>";
            }
        }
    ?>
    <form action="checkLogin.php" method="post"> 
        <input type="text" name="username" placeholder="Enter Username">
        <input type="password" name="password" placeholder="Enter Password">
        <input type="submit" value="Login">
    </form>
</body>
</html>