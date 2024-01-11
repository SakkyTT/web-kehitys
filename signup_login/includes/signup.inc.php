<?php
// === tarkistetaan onko arvot samat ja onko datatyypit samat
// esim. == tulkitsee 5 ja "5" ovat sama arvo
// mutta === vertaa datatyypin myös, jolloin 5 ja "5" eivät ole sama arvo
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    try {
        require_once 'db_connection.inc.php';
        require_once 'signup_model.inc.php'; // Model include ensin
        require_once 'signup_controller.inc.php'; // Sitten controller include

        // ERROR HANDLERS
        $errors = []; // Talennetaan virheet key -> value pareina

        if (is_input_empty($username, $password, $email) === true) {
            $errors["empty_input"] = "Fill in all fields!";
        }
        if (is_email_invalid($email)) {
            $errors["invalid_email"] = "Invalid email used!";
        }
        if (is_username_taken($pdo_conn, $username)) {
            $errors["username_taken"] = "Username already taken!";
        }
        if (is_email_registered($pdo_conn, $email)) {
            $errors["email_used"] = "Email already registered!";
        }

        // Tarvitaan seession aloitus, ennen kuin virheet voidaan tallentaa
        // sesssion_start() löytyy config_session tiedostosta
        require_once 'config_session.inc.php'; //Käytetään turvallisempia sessio asetuksia
        
        // Jos taulukko ei ole tyhjä, on tullut virheitä
        // Jos taulukossa on dataa: $errors === true
        if ($errors) {
            $_SESSION["errors_signup"] = $errors;

            $signupData = [
                "username" => $username,
                "email" => $email
            ];
            $_SESSION["signup_data"] = $signupData;

            // Siirrytään etusivulle ja näytetään virheet
            header("Location: ../index.php");

            $pdo_conn = null;
            $stmt = null;

            die();
        }

        create_user($pdo_conn, $username, $password, $email);
        header("Location: ../index.php?signup=success");

        // Katkaistaan yhteys
        $pdo_conn = null;
        $stmt = null;
        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
    die();
}


// Include tiedostoissa yleensä jätetään php:n lopetus tagi pois