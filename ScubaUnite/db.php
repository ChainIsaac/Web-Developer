<?php 
/**********************************************
 *       db.php
 *       Skriptet skapar en databasuppkoppling
 *       med PDO (PHP Data Object)
 **********************************************/
$db_servname = "localhost";
$db_database = "sep2101_scubaunite"; 
$db_username = "sep2101_ScubaUnite";
$db_password = "{1x#RlQwL[wW";


try {
    $db = new PDO("mysql:host=$db_servname;
                   dbname=$db_database;
                   charset=utf8", 
                   $db_username, 
                   $db_password);

    // set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //echo "Connected successfully"; 
}
catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}