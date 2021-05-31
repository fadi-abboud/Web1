function login(){
 var email = document.getElementById("Lemail").value;
 var password = document.getElementById("Lpassword").value;

 if(email == ""){
   alert("Fillout the email!");
   return;
 }
 if(password == ""){
   alert("Fillout the password!");
   return;
 }
 //Checks if the email is in the correct format.
 //For example alex@email.com
 // asgdgasd or sadsd.com or saddas@asdad are all false
 if(Lemail.checkValidity() == false){
   alert("Enter a correct email /n for example: alex@email.com");
   return;
 }
 else{
   window.location = "main_page.html";
 }
}

function register(){
  var firstName = document.getElementById("firstName").value;
  var lastName = document.getElementById("lastName").value;
  var email = document.getElementById("Remail").value;
  var password = document.getElementById("Rpass").value;
  var passwordRetype = document.getElementById("RRepPass").value;

  if(firstName == ""){
    alert("Enter your name");
    return;
  }
  else if(lastName == ""){
    alert("Enter your last name");
    return;
  }
  else if (email == "") {
    alert("Email required.");
    return;
  }
  else if (password == "") {
    alert("Password required.");
    return;
  }
  else if (passwordRetype == "") {
    alert("Password required.");
    return;
  }
  else if (password != passwordRetype) {
    alert("Password don't match retype your Password.");
    return;
  }
  else if(Remail.checkValidity() == false){
    alert("Enter a correct email /n for example: alex@email.com");
    return;
  }
  else {
    alert(email + "  Thanks for registration.");
    return true;
  }
}

function changeDetails(){
  var firstName = document.getElementById("ChFirstName").value;
  var lastName = document.getElementById("ChLastName").value;
  var email = document.getElementById("ChEmail").value;
  var password = document.getElementById("ChPass").value;
  var passwordRetype = document.getElementById("ChRepPass").value;

  if(firstName != ""){
    document.getElementById("cdFirstName").innerHTML = firstName;
    document.getElementById("ChFirstName").value = "";
  }
  if(lastName != ""){
    document.getElementById("cdLastName").innerHTML = lastName;
    document.getElementById("ChLastName").value = "";
  }
  if (email != "") {
    if(ChEmail.checkValidity() == true){
      document.getElementById("cdEmail").innerHTML = email;
      document.getElementById("ChEmail").value = "";
    }
    else{
      alert("Enter a correct email /n for example: alex@email.com");
    }
  }
  if (password != "") {
    if (password != passwordRetype) {
      alert("Password don't match retype your Password.");
    }
    else{
      alert("Password changed");
      document.getElementById("ChPass").value = "";
      document.getElementById("ChRepPass").value = "";
    }
  }

}
