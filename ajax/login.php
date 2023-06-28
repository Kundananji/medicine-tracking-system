<?php
session_start();
include('../classes/database.php');
include('../classes/login.php');

$username = isset($_POST['username'])?trim($_POST['username']):null;
$password = isset($_POST['password'])?trim($_POST['password']):null;
$rememberMe = isset($_POST['password'])?trim($_POST['password']):null;

if(empty($username)){
    exit(json_encode(array(
        "status"=>"failed",
        "message"=>"Username is missing"
    )));
}

if(empty($password)){
    exit(json_encode(array(
        "status"=>"failed",
        "message"=>"Password is missing"
    )));
}

$login = new Login($username,$password);

if($login->authenticateUser()){
    $login->initiateSession();
    exit(json_encode(array(
        "status"=>"success",
        "message"=>"You have been loggedin successfully!"
    )));
}

exit(json_encode(array(
    "status"=>"failed",
    "message"=>"Invalid Username or password"
)));