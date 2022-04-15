#!/usr/local/bin/php
<?php

$movie = array( "title" => "Rear Window",
                "director" => "Alfred Hitchcock",
                "year" => 1954 );

print_r($movie);

foreach ($movie as $key => $value)
{
    echo "Key: " . $key . "\n"; 
    echo "Value: " . $value . "\n"; 
}

$pwd_file = "../private/passwd";
$u_db = unserialize(file_get_contents($pwd_file));

echo "\nforeach test for u_db\n";
foreach ($u_db as $value)
{
    echo "Login :" . $value['login']. "\n"; 
    echo "Pwd :" . $value['password']. "\n"; 
    
    echo "print whole subarray : \n";
    print_r($value); 
}

print_r($u_db);

echo "\n Example of multi dim with associative sub arrays \n";
foreach ($u_db as $key => $user)
{
    echo "Key :" . $key . "\n"; 
    echo "=> user :" . print_r($user) . "\n"; 
}


?>