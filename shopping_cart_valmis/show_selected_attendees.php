<?php

    // Tässä tiedostossa näytetään käyttäjän valitsemien käyttäjien tiedot.
    // Tämä vastaa ostoskoria / kassaa
    // Eli sessiossa on tallessa vain käyttäjien ID:t. niiden perusteella
    // haetaan käyttäjien tiedot tietokannasta.

    // Samalla tavalla voi tallentaa tuotteiden ID:t sessioon ja lopuksi
    // haetaan tuotteiden tiedot ID:n perusteella ja näytetään käyttäjälle.

    // Sessioon periaatteessa voisi tallentaa kaiken tiedon tuotteeseen liittyen
    // Eikä tarvitse erikseen hakea tietokannasta tietoja lopussa.

    // include toiminto olisi parempi

    session_start();
    // session_unset(); // Poistetaan sessiot
    // session_destroy();

    $host = "localhost";
    $dbname = "eventdatabase";
    $dbusername = "root";
    $bdpassword = "";

    try{
        $pdo_conn = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $bdpassword);
        $pdo_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        die("Connection failed: " . $e->getMessage());
    }

    print_r($_SESSION['users']);
    echo "<br>";

    $placeholders = "";

    // Entä jos ei ole $_SESSION['users']
    foreach($_SESSION['users'] as $sessionUser){
        $placeholders .= "?, ";
    }
    // right trim ("jokin string arvo", "poistettava string")
    $placeholders = rtrim($placeholders, ", ");
    print_r($placeholders);
    echo "<br>";
    $placeholders2 = implode(', ', array_fill(0, count($_SESSION['users']), '?'));
    print_r($placeholders2);

    // ? ovat placeholder symboleja SQL kielessä
    $query = "SELECT * FROM users WHERE userid IN ($placeholders)";
    // $query = "SELECT * FROM users WHERE userid IN (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo_conn->prepare($query);
    echo "<br>";
    // Syötetään arvot placeholder ? tilalle
    // $key on vain indeksi joka kulkee 0, 1, 2, jne
    foreach($_SESSION['users'] as $key => $user){
        // print_r($key);
        // ensimmäinen argumentti ($key + 1) määrittää mihin ? tallennetaan arvo
        // ? ? ? ?
        // 1 2 3 4
        // Toinen argumentti ($user['user_ID']) on = syötettävä arvo
        // Kolmas argumentti (PDO::PARAM_INT) määritellään toisen argumentin
        //    datatyypiksi integer
        $stmt->bindValue($key + 1, $user['user_ID'], PDO::PARAM_INT);
    }

    $stmt->execute();

    // Nyt meillä on kaikki käyttäjät $result muuttujassa array(array(data)...)
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = null; // suljetaan tietokantayhteys

    echo "<br>";
    echo "Haettu data";
    echo "<br>";
    print_r($result);


?>