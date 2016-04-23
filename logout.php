<?php
    session_start();
    unset ($_SESSION["login"]);
    unset ($_SESSION["userId"]);
    unset ($_SESSION["userPass"]);
    if (isset($_COOKIE["PHPSESSID"])) {
        setcookie("PHPSESSID", "", time() - 10, "/");

        session_destroy();
    }

    header ("Location: ./index.php");
?>
