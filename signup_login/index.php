<?php
    require_once "includes/config_session.inc.php";
    require_once "includes/signup_view.inc.php";
    require_once "includes/login_view.inc.php";
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>Document</title>
</head>
<body>
    <?php output_username(); ?>

    <?php
    if(!isset($_SESSION["user_id"])) {?>
    <h3>Login</h3>

    <form action="includes/login.inc.php" method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <button>Login</button>
    </form>

    <?php } ?>

    <?php
        check_login_errors();
    ?>

    <h3>Signup</h3>

    <form action="includes/signup.inc.php" method="post">
        <?php
            signup_inputs()
        ?>
        <button>Signup</button>
    </form>

    <?php
        check_signup_errors();
    ?>

</body>
</html>