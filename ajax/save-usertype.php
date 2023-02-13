<?php
 include('../classes/database.php');
 include('../classes/usertype'.php);

$id= trim(filter_var($_POST['id'],FILTER_SANITIZE_STRING));
$name = trim(filter_var($_POST['name '],FILTER_SANITIZE_STRING));
$description= trim(filter_var($_POST['description'],FILTER_SANITIZE_STRING));
$canAddMedicine= trim(filter_var($_POST['canAddMedicine'],FILTER_SANITIZE_STRING));
$canViewMedicine= trim(filter_var($_POST['canViewMedicine'],FILTER_SANITIZE_STRING));
$canSale= trim(filter_var($_POST['canSale'],FILTER_SANITIZE_STRING));
$canBuy= trim(filter_var($_POST['canBuy'],FILTER_SANITIZE_STRING));
$canReceive= trim(filter_var($_POST['canReceive'],FILTER_SANITIZE_STRING));
$canDeliver= trim(filter_var($_POST['canDeliver'],FILTER_SANITIZE_STRING));
$canDispense= trim(filter_var($_POST['canDispense'],FILTER_SANITIZE_STRING));

$userType = new UserType();
try{
    $savedUserType = $userType->saveUserType($id,$name ,$description,$canAddMedicine,$canViewMedicine,$canSale,$canBuy,$canReceive,$canDeliver,$canDispense,$canAddMedicine);
    if($savedUserType == null){
        exit(json_encode( 
            array(
            "status"=>"failed",
            "message"=>"Failed to add User&nbsp;Type"
        )
        ));
      }
    exit(json_encode(
        array(
            "status"=>"success",
            "message"=>"User&nbsp;Type added successfully"
         )
    ));
}
catch(Exception $ex){
exit(json_encode(
  array(
  "status"=>"failed",
  "message"=>"Failed to add User&nbsp;Type"
)
));
}
