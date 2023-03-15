<?php
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
 header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept, Authorization, X-CSRF-Token");
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phpzag_demos";
$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

if(isset($_POST['username'])) {
	$user_email = trim($_POST['username']);
	$user_password = trim($_POST['password']);
	
	$sql = "SELECT uid, user, pass, email FROM users WHERE email='$user_email'";
	$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
	$row = mysqli_fetch_assoc($resultset);
	if($user_email==""){
		echo "Cannot be Empty";
	}	
	if($row['pass']==$user_password){				
		echo "ok";
		$_SESSION['user_session'] = $row['uid'];
	} else {				
		echo "email or password does not exist."; // wrong details 
	}		
}

?>