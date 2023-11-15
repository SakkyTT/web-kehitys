<?php

    // Tietokanta yhteys
    require "includes/dbconn.php";

    $sql = "SELECT * FROM users";
    $kysely = $conn->prepare($sql);

    $kysely->execute();

    $conn = null;
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    while($row = $kysely->fetch()){
        echo "<p>". htmlspecialchars($row["Username"], ENT_QUOTES, "utf-8") ."</p>";
    }
    ?>
</body>
</html>