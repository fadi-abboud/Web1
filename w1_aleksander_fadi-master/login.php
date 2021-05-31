<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: main_page.php");
    exit;
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = :username";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if username exists, if yes then verify password
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["id"];
                        $username = $row["username"];
                        $hashed_password = $row["password"];
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            // Redirect user to welcome page
                            header("location: main_page.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
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

<!--HTML that will be displayed at index.html as login fields -->
<head>
  <title> Sign In </title>
  <link href="styles.css" type="text/css" rel="stylesheet" />
  <script src="input_validation.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!--Show/Hide password button -->
  <script>
  $(document).ready(function(){
    $("#showPassword").mousedown(function(){
      $("#Lpass").attr('type','text');
  }).mouseup(function(){
      $("#Lpass").attr('type','password');
  }).mouseout(function(){
      $("#Lpass").attr('type','password');
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

<div class="login">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
  <div class="group">
    <input id="Lemail" name="username" type="email" value="<?php echo $username; ?>" required>
    <span class="highlight"></span>
    <span class="bar"></span>
    <span class="error"><?php echo $username_err; ?></span>
    <label>Email</label>
  </div>

  <div class="group">
    <input id="Lpass" type="password"  name="password" value="<?php echo $password; ?>" required>
    <button type="button" id="showPassword" class="ShowPassCheckbox"></button>
    <span class="highlight"></span>
    <span class="bar"></span>
    <span class="error"><?php echo $password_err; ?></span>
    <label>Password </label>
  </div>

<button  type="submit" value="Submit" class="loginButton"> Log In </button>
</form>
<img src="BottomPart.png" alt="huh!" class="BottomPart">

</div>
