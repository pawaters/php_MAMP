<?php
    function create_user($u_db, $login, $pwd, $pwd_file)
    {
        $user = array (
            "login" => $login,
        
            "passwd" => hash ('whirlpool', $pwd, false),
        );
        $u_db[] = $user;
        file_put_contents($pwd_file, serialize($u_db));
    }

    $pwd_file = "../private/passwd";
    $login = $_REQUEST["login"]; 
    $pwd = $_REQUEST["passwd"];
    $submit = $_REQUEST["submit"];

    if ($login && $pwd && $submit == "OK")
    {
        if(!file_exists($pwd_file))
        {
            $u_db = array();
            mkdir(dirname($pwd_file), 0777, true);
            create_user($u_db, $login, $pwd, $pwd_file);
            echo "OK\n";
            header("Location: index.html");
            return ;
        }
        else
        {
            $u_db = unserialize(file_get_contents($pwd_file));
            if ($u_db)
            {
                foreach ($u_db as $user)
                {
                    if ($user["login"] === $login)
                    {
                        echo "ERROR\n";
                        return ;
                    }
                }
                create_user($u_db, $login, $pwd, $pwd_file);
                echo "OK\n";
                header("Location: index.html");
                return ;
            }
        }
    }
    echo "ERROR\n";
    return ;
?>