<?php

// Käydään myöhemmin läpi, kuinka ovat tallessa eri tiedostossa
$host = "localhost";
$dbname = "eventdatabase";
$dbusername = "root";   // Muistakaa vaihtaa
$dbpassword = "";       // Muistakaa vaihtaa

// Luodaan PDO objekti, yhteys tietokantaan tapahtuu PDO objektin kautta
try{
    // Yritetään käyttää tietokantaa

    // Luodaan uusi PDO objecti ja se on tallessa $pdo_conn muuttujassa
    $pdo_conn = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
    $pdo_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // throw new PDOException("Virhe data"); <- tätä varten try catch
    // Täällä suoritettava koodi saattaa heittää tälläisen virheen, joka vaatii
    // try catch rakenteen, jotta koodin suoritus ei kaadu ja hallitaan virhe tilanteet
}
// catch osiossa otetaan exception vastaan johonkin muuttujaan
catch(PDOException $e){
    // Virhe tilanne
    // Lopetetaan suoritus ja näytetään virhe
    // Oikeassa sovelluksessa ei näytetä välttämättä virhe viestiä käyttäjälle (tietoturva)
    die("Connection failed: " . $e->getMessage());
    // logError($e); // Lähetetään virheestä ilmoitus jonnekin
}

// Ei lopetus php tagia