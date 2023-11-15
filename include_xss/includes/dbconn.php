<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eventdatabase";

// Salasanoja ja tunnuksia ei tallenneta koodiin
// Silloin ne ovat version hallinnassa ja vuotavat jonnekin
// Sen sijaan environment variables, salasanat ovat erillisessa 
// tiedostossa tallessa, josta ne haetaan. Eivät ole versionhallinnassa.

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);