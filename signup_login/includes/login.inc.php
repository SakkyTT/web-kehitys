<?php

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    try {
        require_once 'db_connection.inc.php';
        require_once 'login_model.inc.php';
        require_once 'login_controller.inc.php';

        // ERROR HANDLERS
        $errors = []; // Tallennetaan virheet key -> value pareina

        // Tällä kertaa tämä funktio on login_controller tiedostosta
        if (is_input_empty($username, $password)) {
            $errors["empty_input"] = "Fill in all fields!";
        }

        // $pdo_conn tulee 'db_connection.inc.php' tiedostosta
        $result = get_user($pdo_conn, $username);

        if (is_username_wrong($result)) {
            $errors["login_incorrect"] = "Incorrect login info!";
        }

        // Tarkistetaan onko käyttäjän syöttämä $password ja tietokannan $result['pwd']
        // samat arvot
        if (!is_username_wrong($result) && is_password_wrong($password, $result["pwd"])) {
            $errors["login_incorrect"] = "Incorrect login info!";
        }

        // Tarvitaan session aloitus, ennen kuin virheet voidaan tallentaa
        // session_start() löytyy config_session tiedostosta
        require_once 'config_session.inc.php'; // Käytetään turvallisempia sessio asetuksia

        if ($errors) {
            $_SESSION["errors_login"] = $errors;

            header("Location: ../index.php");

            $pdo_conn = null;
            $stmt = null;
            
            die();
        }

        // Luodaan uusi session id, jossa on käyttäjän id mukana
        // Päivitetään myös config_session tiedostoon session päivitys
        $newSessionId = session_create_id();
        $sessionID = $newSessionId . "_" . $result["id"];
        session_id($sessionID);

        // Otetaan talteen kirjautuneen käyttäjän id ja tunnus
        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_username"] = htmlspecialchars($result["username"]);

        // Resetoidaan session aika
        // Rajoitetaan kirjautumisen kestoa, kun käyttäjä käyttää sivua
        // Resetoituu aika
        $_SESSION["last_generation"] = time();

        header("Location: ../index.php?login=success");

        $pdo_conn = null;
        $stmt = null;

        die();
    }
    catch(PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}
else {
    header("Location: ../index.php");
    die();
}