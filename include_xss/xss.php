<?php
    // xss = cross-site-scripting on turvallisuus haavoittuvuus, jossa joku
    // pystyy syöttämään koodia verkkosivulle. Koodi voi tulla esim URL kautta
    // tai se voidaan tallentaa tietokantaan, josta se jaetaan käyttäjien
    // koneille/selaimille.

    $nimi = "";
    if(isset($_GET['input1'])){
        // Käyttäjän syöttämään dataan ei ikinä pidä luottaa
        // htmlspecialchars estää käyttäjän syötteen muokkaavan meidän koodia
        // " => &#34, jolloin se editoi meidän koodia
        $nimi = htmlspecialchars($_GET['input1'], ENT_QUOTES, "utf-8");
    }
    echo "&quot </br>";
    echo "&#34 </br>";    
    echo "&#39 </br>";        
    echo "&#70 </br>";
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="xss.php" method="get">
        <input type="text" name="input1" value="<?php echo $nimi; //if(isset($_GET['input1'])) echo $_GET['input1']; ?>">
        <input type="text" name="input2">
        <input type="submit" value="Send">
    </form>
</body>
</html>