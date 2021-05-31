<?php

//load.php
session_start();

$curMonth = $_REQUEST['curMonth'];

$connect = new PDO('mysql:host=studmysql01.fhict.local;dbname=dbi424684', 'dbi424684', 'AlexFadi12');

$data = array();


$query = "SELECT itemvalue,DATE_FORMAT(start_event, '%d-%M-%Y') AS dateEvent FROM events WHERE userID={$_SESSION['id']} AND MONTH(start_event)= $curMonth  ORDER BY start_event";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();


foreach($result as $row)
{
 echo  "<h3>".  $row["itemvalue"]."$ ". $row["dateEvent"]. "</h3>";
}

$query2 = "SELECT SUM(itemvalue) AS total FROM events WHERE userID={$_SESSION['id']} AND MONTH(start_event)= $curMonth";

$statement2 = $connect->prepare($query2);

$statement2->execute();

$result2 = $statement2->fetchAll();

foreach($result2 as $row)
{
 echo  "<h3>". "Total: ". $row["total"]."$ ".    "</h3><br>";
}


?>
