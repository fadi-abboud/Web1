<?php

//load.php
session_start();

$curMonth = $_REQUEST['curMonth'];

$connect = new PDO('mysql:host=studmysql01.fhict.local;dbname=dbi424684', 'dbi424684', 'AlexFadi12');

$data = array();


$query = "SELECT * FROM events WHERE userID={$_SESSION['id']} AND MONTH(start_event)= $curMonth";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();


foreach($result as $row)
{

 echo  "<h1>".  $row["title"]. "  ".  $row["comment"] ."  ".  $row["itemvalue"]. "</h1><br>";
}



?>
