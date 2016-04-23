<?php

    $link = mysql_connect("localhost", "root", "");
    if (!$link) {
        die ("error");
    }
    $userDB = mysql_select_db("UserInfo", $link);
    if (!$userDB) {
        mysql_close();
        die ("error! cannot get user database");
    }

    session_start();
    if (isset($_SESSION["login"])) {
        if ($_SESSION["login"] == True || isset($_SESSION["userId"]) && isset($_SESSION["userPass"])) {
            $checkId = $_SESSION["userId"];
            $checkPass = $_SESSION["userPass"];
            if (isExistUserInfo ($checkId, $checkPass)) {
                mysql_close();
                header("Location: home.php");
            }
        }
    }

    $userId = $_POST["userId"];
    $userPass = $_POST["userPass"];
    $userId = quote_smart($userId);
    $userPass = quote_smart($userPass);
    if (isExistUserInfo ($userId, $userPass)) {
        $_SESSION["userId"] = $userId;
        $_SESSION["userPass"] = $userPass;
        $_SESSION["login"] = True;
        mysql_close();
        header("Location: home.php");
    } else {
        print ("<h1>wrong user id or password.</h1><a href=\"./login.php\">back</a>");
    }

    mysql_close();

?>


<?php // function
    function isExistUserInfo ($userId, $userPass) {
        if (is_numeric($userId) || is_numeric($userPass)) {
            return False;
        }
        if (strlen($userId) <= 2 || strlen($userPass) < 10) {
            return False;
        }
        if (strlen($userId) > 13 || strlen($userPass) > 32) {
            return False;
        }
        $query = sprintf ("SELECT * FROM UserInfo.user WHERE userId = %s AND userPass = %s", $userId, $userPass);

        $result = mysql_query($query);
        $count = mysql_num_rows($result);
        if ($result && $count) {
            return True;
        }
        return False;
    }

    function quote_smart ($value) {
        $value = "'".mysql_real_escape_string($value)."'";
        return $value;
    }
?>
