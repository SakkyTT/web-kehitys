<?php

// // Without reference
// $array = [1, 2, 3];

// foreach ($array as $value) {
//     $value = $value * 2; // luodaan uudet kopiot
// }

// print_r($array);  // Output: [1, 2, 3]
// echo "<br>";
// // With reference
// $array = [1, 2, 3];

// foreach ($array as &$value) {
//     $value = $value * 2; // & symbol, muokataan alkuperäinen arvo
// }

// print_r($array);  // Output: [2, 4, 6]

// echo "<br>";

    // Tällä sivulla voidaan valita osallistujia eventtiin.
    // Osallistujat tallennetaan sessioon (voisi myös tallentaa tietokantaan)
    // Tämä vastaa tuotteiden lisäystä ostoskoriin

    session_start();
    // session_unset(); // Poistetaan sessiot
    // session_destroy();

    $host = "localhost";
    $dbname = "eventdatabase";
    $dbusername = "root";
    $bdpassword = "";

    try{
        $pdo_conn = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $bdpassword);
        $pdo_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        die("Connection failed: " . $e->getMessage());
    }

    $query = "SELECT * FROM users";
    $stmt = $pdo_conn->prepare($query);

    $stmt->execute();

    // Nyt meillä on kaikki käyttäjät $result muuttujassa array(array(data)...)
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = null; // suljetaan tietokanta yhteys

    // Onko jokin käyttäjä valittu
    if(isset($_POST["user_id"])){
        $user_id = filter_var($_POST["user_id"], FILTER_VALIDATE_INT);

        if($user_id !== false && $user_id > 0){

            // Uusi datarakenne, tehdään käyttäjästä ja sen lukumäärästä association array
            $newEventAttendee = [
                "user_ID" => $user_id,
                "count" => 1, // oletuksena 1
            ];

            $userExists = false;
            // & symbol ennen muuttujaa viittaa alkuperäiseen taulukko elementtiin, eikä luo kopiota
            if(isset($_SESSION["users"]) && count($_SESSION["users"]) > 0){
                foreach($_SESSION["users"] as &$existingUser){
                    // käydään läpi ennestään tallennetut eventAttendee datarakenteet
                    // ja tarkistetaan onko tällä hetkellä tallennettava id jo session taulukossa
                    if($existingUser["user_ID"] === $newEventAttendee["user_ID"]){
                        // Sama id löytyi
                        $existingUser["count"]++;
                        $userExists = true; // Tarvitaan tieto myöhemmin
                        break; // id löytyi, voidaan lopettaa silmukka
                    }
                }
            }

            // Luodaan sessioon tyhjä lista, vain jos sitä ei vielä ole
            if(!isset($_SESSION["users"])){
                // Luodaan tyhjä lista
                $_SESSION["users"] = []; // Shopping cart sessio
            }

            // Jos käyttäjää ei löytynyt, tallennetaan uusi käyttäjä sessioon
            if($userExists === false){
                $_SESSION["users"][] = $newEventAttendee;
            }

            print_r($_SESSION["users"]);

        }
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Events list</h1>

<!-- Tarkistetaan, että kysely palautti dataa -->
<?php if(count($result) > 0): ?>
    <ul>
        <?php foreach ($result as $user): ?>
            <li style="display: flex">

                <?php 
                    // Estetään JavaScript koodin suoritus käyttäjän syöttämästä sisällöstä
                    $userID = htmlspecialchars($user['UserID']);
                    $username = htmlspecialchars($user['Username']);

                echo "$userID - $username"; 
                ?>

                <form style="margin-left: 15px" action="select_event_attendees.php" method="post">
                    <input type="hidden" name="user_id"
                     value="<?php echo $userID; ?>">
                     <button type="submit">Select User</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No users found!</p>
<?php endif; ?>
</body>
</html>