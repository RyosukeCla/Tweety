<?php
    $link = mysql_connect("localhost", "root", "");
    if (!$link) {
        print ("error");
    }
    $userDB = mysql_select_db("UserInfo", $link);
    if (!$userDB) {
        mysql_close();
        print ("error! cannot get user database");
    }
    session_start();
    $userId = $_SESSION["userId"];
    $content = $_POST["content"];
    $query = sprintf ("INSERT INTO tweet (userId, content) VALUES (%s, %s)"
                    , $userId, quote_smart($content));
    if (isset($_POST["content"]) && strlen($content) < 301 && strlen($content) > 0) {
        mysql_query ($query);
    }

    header ("Location: ./home.php");

    mysql_close ();

    function quote_smart ($value) {
        $value = "'".mysql_real_escape_string($value)."'";
        return $value;
    }

?>
