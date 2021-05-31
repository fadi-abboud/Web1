<?php

//load.php
session_start();


$connect = new PDO('mysql:host=studmysql01.fhict.local;dbname=dbi424684', 'dbi424684', 'AlexFadi12');

$data = array();


$query = "SELECT * FROM users WHERE id={$_SESSION['id']}";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();


foreach($result as $row)
{
 echo "<p>".  $row["username"].  "</p>"."<p>".  $row["firstname"].  "</p>". "<p>".  $row["lastname"].  "</p>"   ;
}





?>