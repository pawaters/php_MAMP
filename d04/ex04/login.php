<?php
    require_once("auth.php");
    session_start();
    $pwd_file = "../private/passwd";
    $login    = $_REQUEST["login"];
    $passwd      = $_REQUEST["passwd"];
    $submit   = $_REQUEST["submit"];

    if ($login && $passwd && auth($login, $passwd))
        $_SESSION["loggued_on_user"] = $login;
    else
    {
        $_SESSION["loggued_on_user"] = "";
		header("Location: index.html");
		echo "ERROR\n";
		return ;
    }
?>
<html>
    <head>
        <title>Chat</title>
    </head>
    <body>
        <iframe name="chat" src="chat.php" width="100%" height="550px"></iframe>
        <iframe name="speak" src="speak.php" width="100%" height="50px"></iframe>
    </body>
</html>

