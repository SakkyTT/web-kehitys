<?php
session_start(); // Tarvitaan tiedoston alussa, että sessiot toimii
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <!-- Tervehdi käyttäjää tässä kohtaa -->
        <!-- Tästä jatketaan itsenäisillä tehtävillä! -->
        <?php if($_SESSION["username"]){ // Tarkistetaan onko käyttäjä kirjautunut
            echo "on";
        }else{
            echo "ei ole";
        }
        ?>
    </div>
</body>
</html>