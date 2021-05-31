<?php

//insert.php
session_start();
$id = $_SESSION['id'];
$connect = new PDO('mysql:host=studmysql01.fhict.local;dbname=dbi424684', 'dbi424684', 'AlexFadi12');

if(isset($_POST["title"]))
{
 $query = "
 INSERT INTO events
  (title, comment, start_event, end_event, itemvalue, userId)
  VALUES (:title, :comment, :start_event, :end_event, :price, $id)
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':title'  => $_POST['title'],
   ':comment' => $_POST['comment'],
   ':start_event' => $_POST['start'],
   ':end_event' => $_POST['end'],
   ':price' => $_POST['price']
  )
 );
}

?>
