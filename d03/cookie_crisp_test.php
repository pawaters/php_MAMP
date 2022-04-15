<?php
    if ($_GET["action"] == "set")
    {
        setcookie($_GET["name"], $_GET["value"], time()+3600);
        echo "action :" . $_GET["action"] . "\n";
        echo "name :" . $_GET["name"] . "\n";
        echo "value :" . $_GET["value"] . "\n";
        echo "expires :" . $_GET["expires"] . "\n";
        echo "_COOKIE_expires :" .  $_COOKIE[$_GET["expires"]] . "\n";
        echo "_COOKIE[] :" . $_COOKIE['food'] . "\n";
    }
        
    if ($_GET["action"] == "del")
        setcookie($_GET["name"], "", 0);
    if ($_GET["action"] == "get")
    {
        echo "_COOKIE[_GET[name]] :" . $_COOKIE[$_GET["name"]] . "\n";
        echo "action :" . $_GET["set"] . "\n";
        echo "name :" . $_GET["name"] . "\n";
        echo "value :" . $_GET["value"] . "\n";
        echo "expires :" . $_GET["expires"] . "\n";
    }
?>

//how to get data with _COOKIE_expires