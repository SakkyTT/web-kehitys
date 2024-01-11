<?php
// Tämä tiedosto hallitsee dataa
// Muokkaa tietokantaa model tiedoston kautta

declare(strict_types= 1);

// PHP funktioiden nimeämiskäytäntö: kaikki pienellä ja _ sanojen välissä
function is_input_empty(string $username, string $pass, string $email) {
    // Tarkistetaan onko jokin käytäjän syöte tyhjä
    if (empty($username) || empty($pass) || empty($email)) {
        return true;
    } else {
        return false;
    }
}

// Tarkistetaan jos käyttäjän syöttämä sähköposti ei ole validi "invalid"
function is_email_invalid(string $email) {
    // Tarkistetaan onko käyttäjän syöttämä arvo hyväksyttävä sähköpostiosoite
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function is_username_taken(object $pdo_conn, string $username) {
    if(get_username($pdo_conn, $username)) {
        return true; // Käyttäjänimi on jo käytössä, annetaan virhe
    } else {
        return false; // Käyttäjänimi ei ole käytössä, voidaan jatkaa rekisteröintiä
    }
}

// Kirjoita toiminnallisuus: Käyttäen modelia apuna, funktio tarkastaa onko email
// jo käytössä
function is_email_registered(object $pdo_conn, string $email) {
    if (get_email($pdo_conn, $email)) {
        return true;
    } else {
        return false;
    }
}

// Kirjoita toiminnallisuus: Käyttäen modelia apuna, kirjoita käyttäjän luonti
function create_user(object $pdo_conn, string $username, string $password, string $email) {
    // Täällä voisi olla jotakin muuta logiikkaa
    set_user($pdo_conn, $username, $password, $email);
}
