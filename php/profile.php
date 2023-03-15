<?php
require_once(__DIR__ . '/phpmongodb/vendor/autoload.php');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept, Authorization, X-CSRF-Token");

$client = new MongoDB\Client("mongodb+srv://kavinkumarab:8rpHrWFwoAQ3KqMf@cluster0.gsdbfi0.mongodb.net/test?retryWrites=true&w=majority");
$db = $client->selectDatabase('test');
$col = $db->selectCollection('users');

if (isset($_POST['password'])) {
	$user_email = trim($_POST['username']);
	$user_password = trim($_POST['password']);
    $document = $col->findOne(['email' => $user_email]);
    $document['status']=200;
    $json = json_encode( $document->getArrayCopy() );
    echo $json;
}
if (isset($_POST['user_dob'])) {
	$user_dob = trim($_POST['user_dob']);
	$user_contact = trim($_POST['user_contact']);
    $user_address = trim($_POST['user_dob']);
    $user_email = trim($_POST['username']);
    $updateResult = $col->updateOne(
        ['username' => 'user_email'],
        ['$set' => ['state' => 'ny']]
    );
    $document['status']=200;
    $json = json_encode( $document->getArrayCopy() );
    echo $json;
}
