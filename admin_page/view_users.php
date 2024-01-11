<?php
// sleep(1);
// Tässä tiedostossa listataan kaikki käyttäjät taulukossa
// Taulukossa on napit, joilla käyttäjä voidaan poistaa tai muokata

// 1. Haetaan käyttäjien tiedot
//     a. Tietokanta yhteys (erillinen tiedosto)
//     b. SQL lause ja sen suoritus ja siitä datan haku
//
// 2. Generoidaan käyttöliittymä haetun datan perusteella
//
// 3. Lisätään tyylittelyjä
//
// 4. Lisätään käyttäjän poisto toiminnallisuus "delete" napille
//      a. if, joka tarkistaa, että "delete" löytyy $_POST muuttujassa
//      b. SQL DELETE komento tietokantaan käyttäjän id:llä
//      c. ei DELETE vaan lisätään deleted_at sarake ja PVM milloin käyttäjä poistettiin
//
// 5. Näytetään käyttöliittymässä, mitkä käyttäjät on poistettu
//      a. tietokannasta pitää hakea sarake, jossa tieto poistosta "deleted_at"-sarake
//      b. lisätään jokin tyyli riveille, joiden käyttällä "deleted_at" != null
//
// 6. Lisätään käyttäjän palautus painike
//      a. Lisätään valintarakenne, jossa generoidaan joko poisto ja palautus nappi
//      b. lisätään logiikka, jolla havaitaan napin napsaus. Lisäksi logiikka, joka palauttaa käyttäjän
//              tietokannassa.


// Tietokanta yhteyden koodit löytyy tästä tiedostosta
require_once 'db_connection.inc.php'; // <- $pdo_conn
require_once 'user_operations.inc.php';

// Käyttäjän "poisto"
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['delete'])){
        // delete nappia on painettu
        $userIdToDelete = $_POST["user_id"];
        $operationResult = delete_user($pdo_conn, $userIdToDelete);
    }
}


// Käyttäjän "palautus"
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['restore'])){
        // restore nappia on painettu
        $userIdToRestore = $_POST["user_id"];
        $operationResult = restore_user($pdo_conn, $userIdToRestore);
    }
}

// $queryString = "SELECT * FROM users" // Voi olla myös erillinen muuttuja SQL lauseelle
$stmt = $pdo_conn->prepare("SELECT UserID, Username, email, deleted_at FROM users");

$stmt->execute(); // Suoritetaan SQL lause
$users = $stmt->fetchAll(PDO::FETCH_ASSOC); // Tallennetaan data muuttujaan


?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Users</title>
    <style>
        table {
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
        }        

        th{
            background-color: #D2D2D2
        }

        body{
            display: flex;
            justify-content: center;
        }

        h2 {
            text-align: center;
        }

        /* .custom_button{
            font-weight: bold;
            padding: 15px;
            border-radius: 15px;
            cursor: pointer;
        } */

        .delete{
            background-color: #f5514e;
            font-weight: bold;
            padding: 15px;
            border-radius: 15px;
            cursor: pointer;
            width: 80px;
        }

        .restore{
            background-color: #8CED28;
            font-weight: bold;
            padding: 15px;
            border-radius: 15px;
            cursor: pointer;            
            width: 80px;
        }

        form{
            display: inline-flex;
        }

        .divider{
            width: 12px;
            display: inline-flex;
        }
        
        a{
            display: inline-flex;
        }

        .deleted{
            background-color: #FFD2D2;
        }

        .hidden{
            opacity: 0;
        }
    </style>
</head>
<body>
    <main>

    <h3 <?php if(isset($operationResult) === false) { echo "class='hidden'"; } ?> > 
    <?php if(isset($operationResult)) { echo $operationResult; } else { echo "hidden";} ?>
  </h3>
        
        <h2>User List (vain admin käyttäjät)</h2>
        
        <!-- Tähän taulukkoon generoidaan rivejä $users muuttujan datan perusteella -->
        <table>
            <!-- Otsikko rivi -->
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            <!-- Loopataan läpi $users array ja generoidaan rivejä taulukkoon -->
            <?php foreach($users as $user): ?>
                
                <tr <?php if( $user['deleted_at'] !== null ) echo "class='deleted'"; ?> > <!-- Uusi user rivi alkaa -->
                
                <!-- <td><?php// echo $user["UserID"]; ?></td>  -->
                <td><?= $user["UserID"] ?></td><!-- td on rivin sarakkeita -->
                <td><?= htmlspecialchars($user["Username"]) ?></td>
                <td><?= htmlspecialchars($user["email"]) ?></td>
                <td> <!-- Actions sarake -->
                
                <?php if($user['deleted_at'] === null): ?>
                <!-- Poistetaan käyttäjä tällä sivulla -->
                    <form action="view_users.php" method="post">
                        <input type="hidden" name="user_id" value="<?= $user["UserID"] ?>">
                        <button class="delete" name="delete" type="submit">Delete</button>
                        <!-- <button class="restore" name="restore" type="submit">Restore</button> -->
                        <!-- isset($_POST["delete"]) ja $_POST["user_id"] -->
                    </form>

                <?php else: ?>
                    <form action="view_users.php" method="post">
                        <input type="hidden" name="user_id" value="<?= $user["UserID"] ?>">
                        <button class="restore" name="restore" type="submit">Restore</button>
                    </form>

                <?php endif; ?>

                    <div class="divider"></div>

                    <!-- $_GET["UserID"] -->
                    <a href="edit_user.php?UserID=<?= $user["UserID"] ?>">Edit</a>
                    
                </td><!-- Actions sarake päättyy -->
                
            </tr> <!-- User rivi päättyy -->
            
            <?php endforeach; ?>
        </table>
    </main>
</body>
</html>