<?php


/* Attempt to connect to MySQL database */
try{
    $pdo = new PDO('mysql:host=studmysql01.fhict.local;dbname=dbi424684', 'dbi424684', 'AlexFadi12');
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}
?>
