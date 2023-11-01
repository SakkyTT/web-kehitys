<?php
session_start(); // Tarvitaan tiedoston alussa, että sessiot toimii

// Siirretään käyttäjä pois, jos ei ole kirjautunut
if(isset($_SESSION["username"]) == false){
    header("Location: index.php");
    exit();
}

// Kirjataan käyttäjän ulos sivustolta
if(isset($_GET["logout"])){
    // Varmista käyttäjältä, että haluaa kirjautua ulos.
    
    // Poistetaan kaikki, ehkä joskus halutaan poistaa vain jokin tietty sessio (esim ostoskori)
    session_unset();

    session_destroy();

    header("Location: index.php");
    exit(); // Lopetetaan tiedoston suoritus, ei vahingossa suoriteta ylimääräisiä asioita
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <!-- Logout voisi olla myös linkki-elementti. -->
        <!-- Uloskirjautuminen on yleensä eri tiedostossa. -->
        <form action="memberArea.php" method="get">
            <input type="hidden" name="logout" value="true"> <!-- Tässä kulkee tieto uloskirjautumisesta -->
            <input type="submit" value="Logout">
        </form>
    </header>
    <div class="content">
        <div class="centered">
            <!-- Tervehdi käyttäjää tässä kohtaa -->
    
            <!-- 
                Jos tyyli tiedosto ei päivity hard reload: ctrl + f5     
            -->


            <h1>Terve <?php echo $_SESSION["username"] ?> </h1>    
        </div>
    </div>
</body>
</html>