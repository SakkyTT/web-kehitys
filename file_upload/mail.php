<?php

// Tämä tiedosto käy läpi sähköpostin lähetyksen
// Sähköpostin lähetys tapahtuu SMTP:n kautta (paikallinen tai verkossa)
// Jotta gmail toimii, tarvitaan PHPMailer kirjasto projektissa
// Tässä esimerkissä puuttuu PHPMailer käyttö

// Lisäksi googlen app password gmailin kanssa
// google answers: why-you-may-need-an-app-password
// https://support.google.com/accounts/answer/185833?hl=en#zippy=%2Cwhy-you-may-need-an-app-password



// PHP.ini sisältää oletus asetukset

// ini_set muokkaa tämä suorituksen aikaisen asetuksen
ini_set("SMTP", "smtp.gmail.com"); // Arvot löytyvät googlen sivuilta
ini_set("smtp_port", "587"); // Arvot löytyvät googlen sivuilta

require "gmail.php"; // $password

// Gmail asetukset
ini_set("smtp_auth", "true"); // TLS -> Transport Layer Security -> encryption
ini_set("auth_method", "LOGIN");
ini_set("smtp_username", "t2034323@gmail.com");
ini_set("smtp_password", $password);

$to = "t2034323@gmail.com"; // Jostakin haetaan osoite, esim tietokanta
$subject = "Password recovery tässä oma posti";
$message = "Here is your link to recover password.

            Click here if you did not request this. 
            ";
            // Välttämättä ei ymmärrä tyhjiä välejä ja rivinvaihtoa
$headers = "From: do-not-reply@service.test";

// Asennetaan PHPMailer https://github.com/PHPMailer/PHPMailer
// Lähetetään tieto SMTP palvelimelle käyttämällä tätä kirjastoa

$mail = new PHPMailer();


// mail() palauttaa true tai false, onnistuiko lähetys
$operaationLopputulos = mail($to, $subject, $message, $headers);
// mail() funktio delegoi sähköpostin lähettämisen jollekin SMTP-palvelimelle 
// (Simple Mail Transfer Protocol)
// Aikoinaan PHP on voinut lähettää sähköpostia

if($operaationLopputulos){
    // true
    echo "Email sent!";
}else{
    // false
    echo "Failed to send email!";
    // Jotakin muuta logiikkaa
}


?>