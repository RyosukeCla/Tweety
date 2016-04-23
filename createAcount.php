<?php // main


    $link = mysql_connect("localhost", "root", "");
    if (!$link) {
        die ("error");
    }
    $userDB = mysql_select_db("UserInfo", $link);
    if (!$userDB) {
        mysql_close();
        die ("error! cannot get user database");
    }

    $userId = $_POST["userId"];
    $userPass = $_POST["userPass"];
    $userId = quote_smart($userId);
    $userPass = quote_smart($userPass);

    if (isValidUserInfo($userId, $userPass)) {
        $query = sprintf ("INSERT INTO user (userId, userPass) VALUES (%s, %s)", $userId, $userPass);
        $result = mysql_query($query);
        print ("<h1>Success!!</h1><a href=\"./login.php\">login</a>");
    } else {
        print ("<h1>Failed! Invalid user information. or user id : $userId is already used.</h1><a href=\"./signup.php\">back</a>");
    }

    mysql_close();

?>

<?php // function
    function isValidUserInfo ($userId, $userPass) {
        if (is_numeric($userId) || is_numeric($userPass)) {
            return False;
        }
        if (strlen($userId) <= 2 || strlen($userPass) < 10) {
            return False;
        }
        if (strlen($userId) > 13 || strlen($userPass) > 32) {
            return False;
        }
        $query = sprintf ("SELECT * FROM UserInfo.user WHERE userId = %s", $userId);
        $result = mysql_query($query);
        $count = mysql_num_rows($result);
        if ($count) {
            return False;
        }
        return True;
    }

    function quote_smart ($value) {
        $value = "'".mysql_real_escape_string($value)."'";
        return $value;
    }

?>
