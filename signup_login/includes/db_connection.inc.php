<?php

$host = "localhost";
$dbname = "logindatabase";
$dbusername = "root";
$dbpassword = "";

try {
    $pdo_conn = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
    $pdo_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Include tiedostoissa yleensä jätetään php:n lopetus tagi pois