<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
}

?>


<!DOCTYPE html>
<html>
<head>
  <title> Main Page </title>
  <link href="styles.css" type="text/css" rel="stylesheet" />
  <img class="JustColor" src="JustColor.PNG">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  <script>

  $(document).ready(function() {
    var info =$('#info');

    $("#titleDIV").load('getCurrentTitle.php', {'curMonth': GetCurMonth()});
    $("#commDIV").load('getCurrentCom.php', {'curMonth': GetCurMonth()});
    $("#valueDIV").load('getCurrentValue.php', {'curMonth': GetCurMonth()});

    //create calendar
   var calendar = $('#calendar').fullCalendar({

     //editable must be true so we can configure the calendar
    editable:true,
    showNonCurrentDates: false,
    fixedWeekCount: false,
    header:{
     left:'title',
     center:'',
     right:'prev,next today'
    },

    //this will load the current events.
    //load.php will be written next week.
    events: 'load.php',
    selectable:true,
    selectHelper:true,

    select: function(start, end, allDay)
    {
      //pops us a messagebox to enter the title of the event
      //In our case it's an expense.
     var title = prompt("Enter Expense Title");
     var comment = prompt("Enter Comment (leave blank if you want)");
     if(comment==""){
       comment="no comment";
     }
     var price = prompt("Enter the value");
     if(title)
     {
      var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");

      $.ajax({
        //insert.php will be implemnted next days.
       url:"insert.php",
       type:"POST",
       data:{title:title, start:start, end:end, comment:comment, price:price},
       success:function()
       {
         //update calendar to display the new event
        calendar.fullCalendar('refetchEvents');
        $("#titleDIV").load('getCurrentTitle.php', {'curMonth': getFCcurMonth()});
        $("#commDIV").load('getCurrentCom.php', {'curMonth': getFCcurMonth()});
        $("#valueDIV").load('getCurrentValue.php', {'curMonth': getFCcurMonth()});
        alert("Added Successfully");
       }
      })
     }
    },
    editable:true,

    //If the user clicks on an event or he has paid it,
    //he can delete it.
    eventClick:function(event)
    {
     if(confirm("Are you sure you want to remove it?"))
     {
      var id = event.id;
      $.ajax({
        //delete.php will be implented next days.
       url:"delete.php",
       type:"POST",
       data:{id:id},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        $("#titleDIV").load('getCurrentTitle.php', {'curMonth': getFCcurMonth()});
        $("#commDIV").load('getCurrentCom.php', {'curMonth': getFCcurMonth()});
        $("#valueDIV").load('getCurrentValue.php', {'curMonth': getFCcurMonth()});
        alert("Event Removed");
       }
      })
     }
    },
   });
$('.fc-prev-button').click(function(){
   //Implement php
   var curMonth = getFCcurMonth();
    //implement php
    $("#titleDIV").load('getCurrentTitle.php', {'curMonth': getFCcurMonth()});
    $("#commDIV").load('getCurrentCom.php', {'curMonth': getFCcurMonth()});
    $("#valueDIV").load('getCurrentValue.php', {'curMonth': getFCcurMonth()});
});
$('.fc-next-button').click(function(){
  var curMonth = getFCcurMonth();
   //implement php
   $("#titleDIV").load('getCurrentTitle.php', {'curMonth': getFCcurMonth()});
   $("#commDIV").load('getCurrentCom.php', {'curMonth': getFCcurMonth()});
   $("#valueDIV").load('getCurrentValue.php', {'curMonth': getFCcurMonth()});
});
$(".fc-today-button").click(function() {
  $("#titleDIV").load('getCurrentTitle.php', {'curMonth': getFCcurMonth()});
  $("#commDIV").load('getCurrentCom.php', {'curMonth': getFCcurMonth()});
  $("#valueDIV").load('getCurrentValue.php', {'curMonth': getFCcurMonth()});
});
  });

function getFCcurMonth(){
    var moment = $('#calendar').fullCalendar('getDate');
     return moment.month()+1;
  }
  function GetCurMonth() {
var d = new Date();
return d.getMonth() + 1;
}



  </script>

</head>


<ul class="navigation">

    <img class="logo" src="logo.png" alt="HUH" height="100px">

    <li><a href="main_page.php">Home</a></li>
    <li><a href="change_details.php">Change Details</a></li>
    <li><a href="howtouse.html">How-To</a></li>
    <li class="aboutus"><a href="about_us_and_contact.html">About</a></li>
    <li class="logout"><a href="logout.php">Log out</a> </li>

</ul>

<div id="calendar" class="calendar"></div>

<div id="info" class="MainpageInfo">
</div>

<div id="titleDIV" class="titleDIV">
</div>

<div id="commDIV" class="commDIV">
</div>

<div id="valueDIV" class="valueDIV">
</div>


<img src="BottomPart.png" alt="huh!" class="BottomPart">



</html>
