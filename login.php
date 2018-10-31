<?php
	$host = 'localhost';
	$dbusername = 'root';
	$dbPassword  = '';
	$dbname = 'project';
	$conn = mysqli_connect($host,$dbusername,$dbPassword,$dbname);
	$username =  $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	if ($conn) {
		$query = mysqli_query($conn, "select * from users where email='$email'");
		if ($query && mysqli_num_rows($query) > 0) {
			$userData = mysqli_fetch_assoc($query);
			if ($userData['email'] == $email && $userData['password'] == $password) {
				session_start();
				$_SESSION['userId'] = $userData['id'];
				header('Location: new.php');
			} else {
				header('Location: mini.php?authentication=failed');
			}
		} else {
			// new user
			$newUserQuery = mysqli_query($conn, "insert into users(name,email,password) values('$username','$email','$password')");
			header('Location: new.php');
		}
		
	} else {
		print(mysqli_error($conn));
	}
	die();
	
	/*if ($conn)
	echo'connected successfully';
	$userDataQuery = "select * from users where email='$email'";
	if ($userDataQuery) {
		
		
	} else {
		
$sql = "insert into users(name,email,password) values('$username','$email','$password')";
$query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
	if ($query) {
		session_start();
		$_SESSION['userId'] = mysqli_insert_id($conn);
		header('Location: second.php');
	}
	}
	if ($variable==$username){
		echo "user already exists";
		header('Location: second.php');	
}
*/
?>
