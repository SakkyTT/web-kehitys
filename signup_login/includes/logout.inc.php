<?php
// Sisäänkirjautuessa luodaan $_SESSION["user_id"]
// Joten
// Uloskirjautuminen tarkoittaa session poistamista
session_start();

session_unset();
session_destroy();

header("Location: ../index.php");
die();