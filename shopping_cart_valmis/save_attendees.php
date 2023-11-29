<?php
    // Tässä tiedostossa suoritetaan eventin osallistujien tallennus
    // Vastaa verkkokaupan tilauksen tekemistä
    // Sovelluksen alussa, index.php sivulla valittiin event ja sen ID on 
    // tallennettu sessioon.
    // Nyt sille ID:lle tallennetaan kaikki valitut käyttäjät

    session_start();

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

    $eventID = $_SESSION['selected_event_id'];

    // Suoritetaan tallennus jokaiselle sessiossa olevalle käyttäjälle
    foreach($_SESSION['users'] as $attendee){
        // Haetaan tallennettavan käyttäjän id ja count
        $userID = $attendee['user_ID'];
        $count = $attendee['count'];

        $stmt = $pdo_conn->prepare("INSERT INTO eventattendees (eventid, userid, count)
        VALUES (:eventid, :userid, :count)");
        // bindParam, vältetään SQL injection
        $stmt->bindParam(':eventid', $eventID, PDO::PARAM_INT);
        $stmt->bindParam(':userid', $userID, PDO::PARAM_INT);
        $stmt->bindParam(':count', $count, PDO::PARAM_INT);
    
        $stmt->execute();
        // Voisi tehdä myös yhdellä SQL komennolla
    }


    $pdo_conn = null; // suljetaan yhteys
?>