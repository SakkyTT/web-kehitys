<?php

    // Muuttuja, johon taulukko tallennetaan
    $table = array("Apple", "Banana", "Pear"); // = oikealla puolella luodaan
    $table2 = [1, 2, 3, 4]; // Toinen syntaksi, tehdä taulukko

    array_splice($table, 0 ,2);

    echo $table[0];

    // tietokannan taulukon yksi saadaan array muodossa
    // Joten kaikki taulukon data on array arraytä

    // snake-case ja camel-case

    echo "<br>"; // HTML rivin vaihto

    // Toinen datarakenne, jossa on avaimia ja niihin tallennetaan arvot
    // Esim $_POST ja $_SESSION ovat tälläisiä rakenteita
    // associative array
    $keyValue = [
        // key => value
        "nimi" => "Teemu",
        "osoite" => "Kuopio",
        "email" => "teemu.turunen@sakky.fi",
    ];

    sort($keyValue); // Järjestää datan, mutta avaimet katoavat
    print_r($keyValue);

    echo "<br>";

    // Funktiolla, jolla lasketaan elementtien määrän
    echo count($keyValue); 

    echo "<br>"; 
    array_push($table2, 45); // Lisäys funktio
    print_r($table2);



    // 2D array
    // Ei hyvä nimi alkaa _, joissakin kielissä se tarkoittaa private muuttujaa
    $_2dArray = [
        [1, 2, 4,],
        ["yksi", "viisi", "kaksi"],
        [true, false, true],
    ];
    echo "<br>"; 
    print_r($_2dArray);
    echo "<br>"; 
    echo "<br>"; 
    // Esimerkki kuinka PDO palauttaa dataa
    $PDOdata = array(
        array("EventID" => "1", "EventName" => "Tech Conference", "EventDate" => new DateTime("2023-09-15 19:55:45.123")),
        array("EventID" => "2", "EventName" => "Product Launch", "EventDate" => new DateTime("2023-09-20")),
        array("EventID" => "3", "EventName" => "Networking Mixer", "EventDate" => new DateTime("2023-09-25")),
    );
    print_r($PDOdata);    
    echo "<br>"; 
    echo $PDOdata[1]["EventName"];
    print_r($PDOdata[1]["EventDate"]);
    echo "<br>"; 
    // Silmukka, joka tulostaa datan
    //while($element = $PDO_objekti->fetch()){ // Tietokanta luetaan PDO objektilla, josta saadaan haettua rivi fetch funktiolla
    // Kun data loppuu, fetch palauttaa false ja while päättyy
    foreach($PDOdata as $nimi){ // Koska ei ole nyt PDO objectia, käytetään silmukkana foreach 
        echo "Event ID: " . $nimi["EventID"] . "<br>";
        echo "Event Name: " . $nimi["EventName"] . "<br>";
        echo "Event Date: " . $nimi["EventDate"]->format("d.m.Y") . "<br>";
        echo "<br>";
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