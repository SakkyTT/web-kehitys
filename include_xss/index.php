<?php
    // 4 vaihtoehtoa
    // include, require, include_once, require_once

    // Voidaan lisätä koodia toisesta tiedosta
    include 'file.php'; // <- warning, jatkaa suoritusta

    // Lisää myös tiedoston, mutta lopettaa tiedoston suorituksen jos tiedostoa ei löydy
    // require 'file.php'; // <- fatal error, kaatuu, lopettaa suorituksen

    include 'exists.php';

    include_once 'exists.php'; // Tiedosto ei tule uudestaan, koska esiintyy jo rivillä 11
    // require_once 'file.php';

    require_once 'includes_once/library.php';
    echo "</br>";
    printSomething();
    echo "</br>"; 
    echo returnRandom1to10();
    echo "</br>";
    echo returnCalc(10, 6); // (10 ja 6) sisällä on arguments, funktiolle 
    // arvoja antaessa termi on arguments
    echo "</br>";

    // include_once/require_once on asialle, joka tarvitaan vain kerran. Esim jokin kirjasto
    // jossa on jotain toiminnallisuutta

    // include/require on asialle, jota voidaan käyttää monta kertaa. Esim jokin tiedosto
    // jossa on HTML template, jota voidaan käyttää toistuvasti

    for($i = 0; $i < 10; $i++){
        include 'includes/template.php';
        require './includes/template.php';
    }

?>