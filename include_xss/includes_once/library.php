<?php
    declare(strict_types=1); // Asetetaan, että datatyypit pitää täsmätä
    function printSomething(){
        echo 'jotakin';
    }

    function returnRandom1to10(){
        $randomNumber = rand(1,10);

        return $randomNumber;
    }

    function returnCalc(int $a, int $b){ // Määritellään funktio, kyseessä on parametrit
        return $a / $b;
    }
?>