<?php
    // Tietokanta yhteys
    // Palvelin, tietokanta, tunnukset palvelimelle (user, password)
    $servername = "localhost";
    $databasename = "muokkauskanta";
    $username = "root";
    $password = "";

    try{
        // Luodaan yhteys MySLi tai PDO
        $DBconn = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password); 
         // Tässä objektissa on tallessa tietokantayhteys

        // Virhe asetuksia
        $DBconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Valmistellaan kysely
        $query = $DBconn->prepare("SELECT * FROM users");

        // Suoritetaan kysely
        $query->execute();

        $DBconn = null; // Katkaistaan yhteys

        // echo print_r($query->fetch());
    }
    catch(PDOException $e){
        // Siirrytään tänne, jos try blokin sisällä tapahtuu virhe.
        echo "Connection failed:" . $e->getMessage();
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .allUsers{  
            display: flex;
            justify-content: space-between;
        }

        img{
            width: 100px;
        }
    </style>
</head>
<body>

    <br>
    <br>
    <!-- Tulostetaan kaikki käyttäjät näkyviin, jostakin tietokannasta. -->
    <!-- Lisätkää projektiin kuvia ja lisätkää käyttäjille kuvat. -->

    <!-- <table> -->
    <div class="allUsers">
        <?php
        // Käydään läpi kaikki hakemisen palauttamat rivit
        while($row = $query->fetch()){
            echo "<div>";
            echo "<img src=images/". $row["ProfilePicture"] .">";
            echo "<p>" . $row["UserID"] . "</p>";
            echo "<p>" . $row[1] . "</p>";
            echo "<a href='edit_user.php?userID=" . $row["UserID"] . "'>Edit</a>"; // Linkki muokkaus sivulle
            echo "</div>";
        }
        ?>
    </div>

</body>
</html>