<html>
<head>
<title>
To Do List
</title>
<style>
form{
background-color : white;
margin:uto;
padding:5%;
}
</style>
</head>
<body BGCOLOR = "#239B56">
<font size = "8"><center> TO DO LIST </center></font>
<?php

	session_start();
	if (isset($_SESSION['userId'])) {
		header('Location: new.php');
	}

	if (isset($_GET['authentication']) && $_GET['authentication'] == 'failed') {
		echo "invalid username and password";
	}
?>
<fieldset>
<legend><center> Login Page </center></legend>
<form align = "center" action = "login.php" method = "POST">
Name:<input type  = "text" name = "username" placeholder = "Name" required  ><br><br>
Email:<input type = "text" name = "email" placeholder = "email address" required><br><br>
Password:<input type = "text" name = "password"  placeholder = "password" required ><br><br>
<button type= "submit" namae = "submit" > Submit</button>
</form>
</body>
</html>
