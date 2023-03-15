<?php
require_once(__DIR__ . '/phpmongodb/vendor/autoload.php');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept, Authorization, X-CSRF-Token");


$client = new MongoDB\Client("mongodb+srv://kavinkumarab:8rpHrWFwoAQ3KqMf@cluster0.gsdbfi0.mongodb.net/test?retryWrites=true&w=majority");
$db = $client->selectDatabase('test');
$col = $db->selectCollection('users');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phpzag_demos";
$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}

if (isset($_POST['btn-save'])) {
	$user_name = $_POST['user_name'];
	$user_email = $_POST['user_email'];
	$user_contact = $_POST['user_contact'];
	$user_dob = $_POST['user_dob'];
	$user_password = $_POST['password'];
	$insertOneResult = $col->insertOne([
		'name' => $_POST['user_name'],
		'email' => $_POST['user_email'],
		'password' => $_POST['password'],
		'dob' =>$_POST['user_dob'],
		'contact' => $_POST['user_contact'],
	]);
	$sql = "SELECT email FROM users WHERE email='$user_email'";
	$resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
	$row = mysqli_fetch_assoc($resultset);
	if (!$row['email']) {
		$sql = "INSERT INTO users(`uid`, `user`, `pass`, `email`, `profile_photo`) VALUES (NULL, '$user_name', '$user_password', '$user_email', NULL)";
		mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn) . "qqq" . $sql);
		echo "registered";
	} else {
		echo "1";
	}
}
