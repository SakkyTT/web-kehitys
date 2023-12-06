<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Search</title>
</head>
<body>

    <h2>User Search</h2>

    <!-- Haku lomake -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="search">Search by username:</label>
        <input type="text" id="search" name="search" required>
        <button type="submit">Search</button>
    </form>

    <?php
    // Käyttäjä on syöttänyt hakusanan lomakkeeseen
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        // Haetaan käyttäjän syöttämä haku
        $searchInput = $_POST["search"];

        // Lisätään hakuun jokerimerkit molemmille puolille hakusana
        $search = "%" . $searchInput . "%";

        // Esim: "leipä" löytyy haulla "lei%", koska haettavan sanan pitää alkaa merkeillä "lei", mutta %
        // jälkeen ei ole väliä. Joten hakusanalla "lei" ja % lopussa löytyy:
        //      - leipä, leivos, leikki, leipoa jne.. kaikki sanat, joka alkaa merkeillä "lei"

        // Jos lisätään jokerimerkki alkuun ja loppuun esim: "%eip%"
        // Silloin löytyy "leipä", "reipas", "leipoa" jne



        $host = "localhost";
        $dbname = "eventdatabase";
        $dbusername = "root";
        $dbpassword = "";

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // SQL LIKE syntaksi
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username LIKE :search");
            $stmt->bindParam(':search', $search, PDO::PARAM_STR);
            $stmt->execute();

            echo "<h3>Search Results:</h3>";
            echo "<table>";
            echo "<tr><th>ID</th><th>Username</th><th>Email</th></tr>";

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr><td>{$row['UserID']}</td><td>{$row['Username']}</td><td>{$row['email']}</td></tr>";
            }

            echo "</table>";

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $pdo = null; // Close the connection
    }
    ?>

</body>
</html>