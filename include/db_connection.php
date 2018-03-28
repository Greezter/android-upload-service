<?php
    /**
    *Database config variables,
    */
    define("DB_HOST","YOUR HOST NAME"); 
    define("DB_USER","YOUR USERNAME");
    define("DB_PASSWORD","YOUR PASSWORD");
    define("DB_DATABASE","DATABASE NAME");
 
    $connection = <a href="#">mysql</a>i_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
 
    if(<a href="#">mysql</a>i_connect_errno()){
        die("Database connnection failed " . "(" .
            <a href="#">mysql</a>i_connect_error() . " - " . <a href="#">mysql</a>i_connect_errno() . ")"
                );
    }
?>