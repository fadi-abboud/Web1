<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$firstname = $lastname = $username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate username
    if(empty(trim($_POST["username"]))){

    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = :username";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        unset($stmt);
    }

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
      $firstname = trim($_POST["firstname"]);
      $lastname = trim($_POST["lastname"]);

        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password, firstname, lastname) VALUES (:username, :password, :firstname, :lastname)";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":firstname", $param_firstname, PDO::PARAM_STR);
            $stmt->bindParam(":lastname", $param_lastname, PDO::PARAM_STR);

            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_firstname = $firstname;
            $param_lastname = $lastname;

            // Attempt to execute the prepared statement
            if($stmt->execute()){

              $msg = "this is msg";
              $headers = 'From: i424684@hera.fhict.nl' . "\r\n";
              $retval =mail("a.sopiqoti@student.fontys.nl","My subject",$msg,$headers);
              if( $retval == true ) {
                echo "Message sent successfully...";
              }else {
                 echo error_get_last()['message'];
              }
                // Redirect to login page
                //header("location: main_page.php");

            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        unset($stmt);
    }

    // Close connection
    unset($pdo);
}
?>

<!DOCTYPE html>
<head>
  <!-- This HTML contains the register fields and button that will be displayed on the index.html -->
<link href="styles.css" type="text/css" rel="stylesheet" />
<script src="input_validation.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!--Show/Hide password button -->
<script>
$(document).ready(function(){
  $("#showPassword").mousedown(function(){
    $("#Rpass").attr('type','text');
}).mouseup(function(){
    $("#Rpass").attr('type','password');
}).mouseout(function(){
    $("#Rpass").attr('type','password');
});
$("#showRepPassword").mousedown(function(){
    $("#RRepPass").attr('type','text');
}).mouseup(function(){
    $("#RRepPass").attr('type','password');
}).mouseout(function(){
    $("#RRepPass").attr('type','password');
});
});
</script>
<img class="JustColor" src="JustColor.PNG">
</head>
<div class="navigation mb-50px">
    <ul>
        <img class="logo" src="logo.png" alt="HUH" height="100px">
        <li><a href="index.html">Home</a></li>
        <li class="aboutus"><a href="about_us_and_contact.html">About</a></li>

    </ul>
</div>
<!-- <a href="Contract_Aleksander_Fadi.pdf" >
 Please downlaod the Contract_Aleksander_Fadi pdf file </a> */
-->
<img class="main_image" src="main_image.png" alt="HUH" width="800" />

<!-- The divider in which the login or register fields will appear. -->
<div id="ajaxContent" class="ajaxContent" >
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
  <div class="register">
  <br>
      <div class="group">
        <input id="firstName"  type="text" name="firstname" value="<?php echo $firstname; ?>"   required>
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>First Name</label>
      </div>

      <div class="group">
        <input id="lastName" type="text" name="lastname" value="<?php echo $lastname; ?>"required>
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Last Name</label>
      </div>

      <div class="group">
        <input id="Remail" name="username" type="email" value="<?php echo $username; ?>" required>
        <span class="highlight"></span>
        <span class="bar"></span>
        <span class="help-block"><?php echo $username_err; ?></span>
        <label>Email</label>
      </div>

      <div class="group">
        <input id="Rpass" type="password"  name="password" value="<?php echo $password; ?>" required>
        <button type="button" id="showPassword" class="ShowPassCheckbox"></button>
        <span class="highlight"></span>
        <span class="bar"></span>
        <span class="error"><?php echo $password_err; ?></span>
        <label>Password </label>
      </div>

      <div class="group">
        <input id="RRepPass" type="password" name="confirm_password" value="<?php echo $confirm_password; ?>"  required>
        <span class="highlight"></span>
        <span class="bar"></span>
        <span class="error"><?php echo $confirm_password_err; ?></span>
        <label>Repeat Password</label>
        <button type="button" id="showRepPassword" class="ShowPassCheckbox"></button>
      </div>

      <button type="submit" value="Submit" class="registerButton" > Register </button>

  </div>
  </form>
</div>
<img src="BottomPart.png" alt="huh!" class="BottomPart">
