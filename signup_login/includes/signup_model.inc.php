<?php
// Tietokanna käyttö tässä tiedostossa
// Vain controller tiedosto käyttää tätä model tiedostoa

declare(strict_types=1);

// Funktio hakee tietokannasta parametrinä saadun käyttäjänimen
// Tietokanta yhteys objecti PDO, saadaan parametrinä/argumenttinä signup tiedostosta
function get_username(object $pdo, string $username) {
    $query = "SELECT username FROM users WHERE username= :username";
    // stmt = statement lyhtennettynä
    $stmt = $pdo->prepare($query);
    // bindParam = syötetään käyttäjän data (username) SQL kyselyyn tavalla, joka estää
    // SQL injektion
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    // Hakee rivin dataa suoritetusta hausta (fetch). Palauttaa datan
    // associate arrays muodossa "sarakkeen_nimi" => arvo (FETCH_ASSOC)
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result; // Saadaan palautuksena joko käyttäjänimi tai false (jos dataa ei löytynyt)
}

// Haetaan käyttäjä. jolla on tietty sähköpostiosoite
function get_email(object $pdo, string $email) {
    $query = "SELECT username FROM users WHERE email= :email";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);

    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}

function set_user(object $pdo, string $username, string $password, string $email) {
    $query = "INSERT INTO users (username, pwd, email) VALUES (:username, :passwd, :email)";

    $stmt = $pdo->prepare($query);

    // Hash algorithmin laskennallinen hinta, isompi luku => monimutkaisempi salana
    $options = ["cost" => 12];

    // Salasana häshätään muotoon, jota ei voida lukea. Esim. jos salasana
    // on "Tomi1234", niin se muutetaan muotoon "VG9taTEyMzQ=". Ideana on,
    // algoritmi muuttaa saman salasanan aina samaan muotoon. Näin meidän ei tarvitse
    // tietää mikä käyttäjän salasana on, riittää että vertaamme käyttäjän syöttämää
    // salasanaa häshättynä siihen, mikä meillä on tietokannassa.
    $hashedpwd = password_hash($password, PASSWORD_BCRYPT, $options);
    // $2y$10$8UIzH4iURy/lJ0MLjBjexuJXr2ZT4g9czo6CkpPG3V8PZdZ8G5X12
    // Tästä ei voida ikinä palauttaa alkuperäistä sanaa
    // Voidaan vain hashata alkuperäinen sana uudelleen ja verrata lopputulos

    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":passwd", $hashedpwd);
    $stmt->bindParam(":email", $email);

    $stmt->execute();
}