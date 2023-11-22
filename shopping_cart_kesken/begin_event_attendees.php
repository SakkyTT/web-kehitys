<?php
    // Tämä tiedoston tarkoitus on aloittaa session, jossa on tallessa valitun eventin
    // ID.
    // Siirretään käyttäjä sitten eteenpäin osallistujien valinta sivulle.

    // Tämä voisi vastata sitä, kun käyttäjä kirjautuu verkkokauppaan

    session_start(); // Tarvitaan sessiota varten

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // isset tarkistaa (is set) onko jokin muuttuja olemassa
        if(isset($_POST["event_id"])){
            // Tarkistetaan, että POST:n arvo on hyväksyttävä int arvo ( filter_var() )
            // Vaikka POST on meidän generoima arvo index sivulla, mikään ei estä
            // käyttäjää ottamasta yhteyttä tälle sivulle POST metodilla.
            $event_id = filter_var($_POST["event_id"], FILTER_VALIDATE_INT); // ehkä false

            if($event_id !== false && $event_id > 0){
                $_SESSION["selected_event_id"] = $event_id;

                // Siirrytään valitsemaan käyttäjiä
                header("Location: select_event_attendees.php");
                exit;
            }
        }
        else{
            echo "Event ID not Provided";
            exit;
        }
    }
    else{
        header("Location: index.php?nopost=true");
        exit;
    }
?>