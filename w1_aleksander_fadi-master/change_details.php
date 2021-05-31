<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
}

require_once "config.php";

$firstname = $lastname = $username = $password = $confirm_password = "";

//change email if email input field it's not empty
if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(empty(trim($_POST["username"]))){

  }else{
    $sql = "UPDATE users SET username=:username WHERE id={$_SESSION['id']}";

    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

        // Set parameters
        $param_username = trim($_POST["username"]);

        // Attempt to execute the prepared statement
        $stmt->execute();

    // Close statement
    unset($stmt);
  }
}
}
//change lastname if lastname field input is not empty
if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(empty(trim($_POST["lastname"]))){

  }else{
    $sql = "UPDATE users SET lastname=:lastname WHERE id={$_SESSION['id']}";

    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":lastname", $param_lastname, PDO::PARAM_STR);

        // Set parameters
        $param_lastname = trim($_POST["lastname"]);

        // Attempt to execute the prepared statement
        $stmt->execute();

    // Close statement
    unset($stmt);
  }
}
}

//change firstname if firstname field input is not empty
if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(empty(trim($_POST["firstname"]))){

  }else{
    $sql = "UPDATE users SET firstname=:firstname WHERE id={$_SESSION['id']}";

    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":firstname", $param_firstname, PDO::PARAM_STR);

        // Set parameters
        $param_firstname = trim($_POST["firstname"]);

        // Attempt to execute the prepared statement
        $stmt->execute();

    // Close statement
    unset($stmt);
  }
}
}
//Change the password if password field is not empty, also if it matches with repeat password.
if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(empty(trim($_POST["password"]))){

  }else{
    if(strlen(trim($_POST["password"])) > 5){
      $password =trim($_POST["password"]);
      $confirm_password = trim($_POST["confirm_password"]);
      if($password == $confirm_password){
        $sql = "UPDATE users SET password=:password WHERE id={$_SESSION['id']}";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
          $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);

            // Set parameters
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            // Attempt to execute the prepared statement
            $stmt->execute();

        // Close statement
        unset($stmt);
      }
    } else{
      $msg1 = "Passwords do not match";
      echo "<script type='text/javascript'>alert('$msg1');</script>";
    }

    } else{
      $msg = "Password must be longer than or equal to 6 characters";
      echo "<script type='text/javascript'>alert('$msg');</script>";
    }
}
$password ="";
$confirm_password ="";
}



?>
<!DOCTYPE html>
<html lang="en">
<!--The purpose of this webpage, is for the user to
change his details or password  -->

<head>
    <title> Change Details</title>
    <link href="styles.css" type="text/css" rel="stylesheet" />
    <img class="JustColor" src="JustColor.PNG">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        $("#currentDetailsInfo").load('getPersonalInfo.php');
    });
    </script>
</head>

<body>
    <!--Navbar -->
    <div class="navigation mb-50px">

        <ul>
            <img class="logo" src="logo.png" alt="HUH" height="100px">
            <li><a href="main_page.php">Home</a></li>
            <li><a href="change_details.php">Change Details</a></li>
            <li><a href="howtouse.html">How-To</a></li>
            <li class="aboutus"><a href="about_us_and_contact.html">About</a></li>
            <li class="logout"><a href="logout.php">Log out</a> </li>

        </ul>

    </div>

    <!-- made col within one row to wrap the info details-->
    <div class="row">
            <div class="col">

                <div class="currentInfo">
                    <!-- Labels of the information that needs to be changed -->
                    <div class="currentDetails">
                        <p>Email adress:</p>
                        <p>First Name: </p>
                        <p>Last Name: </p>
                        <p>New Password:</p>
                        <!-- <p>Repeat password: </p> -->
                    </div>

                    <!-- The current information of the user.
                  It is updated once the user saves his changes -->

                </div>
            </div>
            <div id="currentDetailsInfo" class="currentDetailsInfo">


                        <!-- <p>Repeat New password: </p> -->
                    </div>

            <div class="col">
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <!-- Input fields -->
                <div class="currentDetailsInput ">

                    <div class="group ">
                        <input id="ChEmail" type="email" name="username" value="<?php echo $username; ?>"  >
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Click here to change email</label>
                    </div>
                    <div class="group">
                        <input id="ChFirstName" type="text" name="firstname" value="<?php echo $firstname; ?>"  >
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Click here to change first name</label>
                    </div>
                    <div class="group">
                        <input id="ChLastName" type="text" name="lastname" value="<?php echo $lastname; ?>" >
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Click here to change last name</label>
                    </div>
                    <div class="group">
                        <input id="ChPass" type="password" name="password" value="<?php echo $password; ?>" >
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Click here to change password</label>
                    </div>
                    <div class="group">
                        <input id="ChRepPass" type="password"  name="confirm_password" value="<?php echo $confirm_password; ?>" >
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Repeat password</label>
                    </div>
                </div>
  <button type="submit" value="Submit" class="SaveDetails" > Save </button>
  </form>
        </div>


    </div>
</body>
<img src="BottomPart.png" alt="huh!" class="BottomPart">
</html>
