<?php
    session_start();
    function ft_get_chats($chat_file)
    {
        if (file_exists($chat_file))
        {
            $content = file_get_contents($chat_file, LOCK_EX);
            $chats = unserialize($content);
            return $chats;
        }
        return FALSE;
    }

    $chat_file = "../private/chat";
    $msg = $_REQUEST["msg"];
    if ($_SESSION["loggued_on_user"] === "")
    {
        echo "ERROR\n";
        return ;
    }
    if (isset($msg))
    {
        $msg = array (
            "login" => $_SESSION["loggued_on_user"],
            "time" => time(),
            "msg" => $msg
        );
        $chats = ft_get_chats($chat_file);
        $chats[] = $msg;
        if (file_put_contents($chat_file, serialize($chats), LOCK_EX) === FALSE)
        {
            header("Location: index.html");
			echo "ERROR\n";
        } 
    }
?>

<html>
    <head>
        <title>Message</title>
    </head>
    <body>
        <form method="post" action="speak.php">
			<input type="text" name="msg"/></br></br>
		</form>
	</body>
</html>