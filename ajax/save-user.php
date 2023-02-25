<?php
 include('../classes/database.php');
 include('../classes/user.php');

$id= trim(filter_var($_POST['id'],FILTER_SANITIZE_STRING));
$name= trim(filter_var($_POST['name'],FILTER_SANITIZE_STRING));
$address= trim(filter_var($_POST['address'],FILTER_SANITIZE_STRING));
$email= trim(filter_var($_POST['email'],FILTER_SANITIZE_STRING));
$username= trim(filter_var($_POST['username'],FILTER_SANITIZE_STRING));
$password= trim(filter_var($_POST['password'],FILTER_SANITIZE_STRING));
$userTypeId= trim(filter_var($_POST['userTypeId'],FILTER_SANITIZE_STRING));
$publicKey= trim(filter_var($_POST['publicKey'],FILTER_SANITIZE_STRING));
$ipAddress= trim(filter_var($_POST['ipAddress'],FILTER_SANITIZE_STRING));

$user = new User();
try{
    $savedUser = $user->saveUser($id,$name,$address,$email,$username,$password,$userTypeId,$publicKey,$ipAddress);
    if($savedUser == null){
        exit(json_encode( 
            array(
            "status"=>"failed",
            "message"=>"Failed to add User"
        )
        ));
      }
    exit(json_encode(
        array(
            "status"=>"success",
            "message"=>"User added successfully"
         )
    ));
}
catch(Exception $ex){
exit(json_encode(
  array(
  "status"=>"failed",
  "message"=>"Failed to add User"
)
));
}
