<?php
    session_start();
    // ログインしているか確認
    if (isset($_SESSION["login"])) {
        if ($_SESSION["login"] == True) {
            header ("Location: ./loginAcount.php");
        }
    }
?>

<html>
<head><title>Signup or Login</title></head>
<body>

<div>
    <li><a href="./login.php">login</a> (if you already have an account.) </li>
    <li><a href="./signup.php">signup</a> (create new account.) </li>
</div>

</body>
</html>
