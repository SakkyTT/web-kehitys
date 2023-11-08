<?php
// Tarkistetaan, että requestin mukana tulee GET userID
if(isset($_GET["userID"]) && filter_var($_GET['userID'], FILTER_VALIDATE_INT)){

    // Tietokanta yhteys
    // Palvelin, tietokanta, tunnukset palvelimelle (user, password)
    // Osittain tietokantayhteyden haun, voisi laittaa erilliseen tiedostoon
    // jota voidaan käyttää eri tiedostoissa
    $servername = "localhost";
    $databasename = "muokkauskanta";
    $username = "root";
    $password = "";

    $userID = $_GET['userID'];

    try{
        // Luodaan yhteys MySLi tai PDO
        $DBconn = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password); 
         // Tässä objektissa on tallessa tietokantayhteys

        // Virhe asetuksia
        $DBconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Valmistellaan kysely
        // SQL injection harjoitus
        echo "SELECT * FROM users WHERE UserID = $userID";
        // $query = $DBconn->prepare("SELECT * FROM users WHERE UserID = $userID");

        // Toinen tapa välttää SQL injection
        $sql = "SELECT * FROM users WHERE UserID = :userID";
        $query = $DBconn->prepare($sql);
        $query->bindParam(':userID', $userID, PDO::PARAM_INT);

        // Suoritetaan kysely
        $query->execute();

        $DBconn = null; // Katkaistaan yhteys

        echo print_r($query->fetch());
    }
    catch(PDOException $e){
        // Siirrytään tänne, jos try blokin sisällä tapahtuu virhe.
        echo "Connection failed:" . $e->getMessage();
    }

}else{
    // Siirretään käyttäjä takaisin
    header("Location: index.php?error=true");
    exit(); // Lopetetaan tiedoston suoritus
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>