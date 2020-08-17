<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="assets/css/style.css">
<?php
include 'php_function.php';
?>
<script>
function validateForm() {
	var login = document.forms["myForm"]["login"].value;
	var password = document.forms["myForm"]["password"].value;
	var fname = document.forms["myForm"]["fname"].value;
	var lname = document.forms["myForm"]["lname"].value;
	var email = document.forms["myForm"]["email"].value;
	var err = 0;
	
	document.getElementById('error-login').innerHTML = "";
	document.getElementById('error-password').innerHTML = "";
	document.getElementById('error-fname').innerHTML = "";
	document.getElementById('error-lname').innerHTML = "";
	document.getElementById('error-email').innerHTML = "";
	
	if (fname.length<1) {
        document.getElementById('error-fname').innerHTML = "Brak imienia";
		err = err+1;
	}
	
	if (lname.length<1) {
        document.getElementById('error-lname').innerHTML = "Brak nazwiska ";
		err = err+1;
	}
	
	if (email.length<1) {
        document.getElementById('error-email').innerHTML = "Brak maila";
		err = err+1;
	}
	
	if(login.length < 6){
		document.getElementById('error-login').innerHTML = "Login powinien zawierać minimum 6 znaków";
		err = err+1;
	}
	
	if(login.length >= 6){
		if(/^[A-Za-z]\w{6,35}$/.test(login) == false){
			document.getElementById('error-login').innerHTML = "Login może zawierać tylko litery i liczby";
			err = err+1;
		}
	 }
			
	if(email.length >= 8)
	{		
	  
	  if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email) == false){
		  document.getElementById('error-email').innerHTML = "Niepoprawna walidacja";
		  err = err+1;
	  }	
	 }
	 if (password.length < 8) {
        document.getElementById('error-password').innerHTML = "Hasło powinno zawierać minimum 6 znaków";
		err = err+1;
	 }	
	 if(password.length >= 8){
		if(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,35}$/.test(password) == false){
			document.getElementById('error-password').innerHTML = "Hasło musi zawierać małe oraz wielkie litery, liczby oraz znaki specjalne ";
			err = err+1;
		}
	 }
	 checklog(login);
	 checkemail(email);
	 
	if(err ==0){
		return true;
	}else{
	return false;}
	
}

/^[A-Za-z]\w{7,14}$/


function validateDelUsr(){
  var txt;
  var r = confirm("Press a button!");
  if (r == true) {
    Alert("You pressed OK!");
   return true;

  } else {
    Alert(txt = "You pressed Cancel!");
   return false;
  }
  }


function checklog(str) {
  if (str.length == 0) {
    document.getElementById("login").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("error-login").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("POST", "checklogin.php?login=" + str, true);
    xmlhttp.send();
  }
}

function checkemail(str) {
  if (str.length == 0) {
    document.getElementById("email").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("error-email").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("POST", "checkemail.php?email=" + str, true);
    xmlhttp.send();
  }
}



</script>
 
</head>
<body>
<form class="form-style-7" name="myForm" method="POST" action="" onsubmit="return validateForm()">
<ul>
<li>
	<label for="login">Login</label>
	<input type="text" id="login" name="login"><span id="error-login" class="error"></span>
	<span>Podaj twoj login</span>
</li>
<li>
	<label for="password">Hasło</label>
	<input type="password" id="password" name="password"><span id="error-password" class="error"></span>
	<span>Podaj twoje haslo</span>
</li>
<li>
	<label for="fname">Imie</label>
	<input type="text" id="fname" name="fname"> <span id="error-fname" class="error"></span>
	<span>Podaj twoje imie</span>
</li>
<li>
	<label for="lname">Nazwisko</label>
	<input type="text" id="lname" name="lname"><span id="error-lname"class="error"></span>
	<span>Podaj twoje nazwisko</span>	
</li>
<li>
	<label for="email">Email</label>
	<input type="text" id="email" name="email"><span id="error-email"class="error"></span>
	<span>Podaj twoj email</span>
</li>
<li>
<input class="button" type="submit" name="add_user" value="Zarejestruj sie">
</li>
</ul>  
</form>
<br>
<br>




</body>
</html>