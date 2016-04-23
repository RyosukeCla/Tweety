<html>
<head><title>Home</title></head>
<body>

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
    print ("<h1> $userId - home </h1>");
    print ("<a href = \"./logout.php\">log out</a></br>");

    $result = mysql_query("SELECT userId, content FROM tweet");
    if (!$result) {
        print ("cannot load tweets. please reload.");
    }
?>

<form action = "tweet.php" method = "post" >
    tweet - (1 ~ 300 character) </br>
    <textarea cols = "50" rows = "6" placeholder = "tweety" name = "content"></textarea>
    <input type = "submit" name = "tweet">
</form>

<div>

    <?php
        while ($tweets = mysql_fetch_assoc ($result)) {
            print ("<p>----------- ");
            print ($tweets["userId"]);
            print (" ------------ </br>");
            print ($tweets["content"]);
            print ("<br>------------------------------------</p>");
        }
        mysql_close();
    ?>

</div>

</body>
</html>
