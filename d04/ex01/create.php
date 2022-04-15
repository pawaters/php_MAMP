<?php

    function create_user($u_db, $login, $pwd, $pwd_file)
    {
        //function to create user array with all input data
        $user = array (
            "login" => $login,
        //we hash the password right away
            "password" => hash ('whirlpool', $pwd, false),
        );
        $u_db[] = $user;
        //as an array cannot be stored outside of a running PHP script as it is,
        //we serialize it, put into a format so it can be handled (ex:JSON)
        file_put_contents($pwd_file, serialize($u_db));
    }

    //the accounts must be stored in /private/passwd, serialized
    $pwd_file = "../private/passwd";
    //collect data from form and put in easy to manipulate vars
    $login = $_REQUEST["login"]; //can catch data from GET or POST
    $pwd = $_REQUEST["passwd"];
    $submit = $_REQUEST["submit"];

    if ($login && $pwd && $submit == "OK")
    {
        //initialisation if first user creation
        if(!file_exists($pwd_file))
        {
            $u_db = array();
            //create the folder where the u_db will be
            mkdir(dirname($pwd_file), 0777, true);
            create_user($u_db, $login, $pwd, $pwd_file);
            echo "OK\n";
            return ;
        }
        //if not first user created, we store in existing u_db
        else
        {
            $u_db = unserialize(file_get_contents($pwd_file));
            if ($u_db)
            {
                //check the username does not already exist in the db
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
                return ;
            }
        }
    }
    echo "ERROR\n";
    return ;


?>