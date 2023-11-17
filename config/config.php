<?php

    try {
        //Host
        define("HOST", "localhost");

        //DBName
        define("DBNAME", "hotel_a");

        //User
        define("USER", "root");

        //Password
        define('PASS', '');

        $conn = new PDO("mysql:host=".HOST.";dbname=".DBNAME."", USER, PASS);
        $conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //if ($conn == true) echo "Connection established";
        
    } catch (PDOException $e) {
        return "Error: ".$e->getMessage();
    }

?>