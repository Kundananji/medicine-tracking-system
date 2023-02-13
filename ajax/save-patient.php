<?php
 include('../classes/database.php');
 include('../classes/patient'.php);

$id= trim(filter_var($_POST['id'],FILTER_SANITIZE_STRING));
$name= trim(filter_var($_POST['name'],FILTER_SANITIZE_STRING));
$dateOfBirth= trim(filter_var($_POST['dateOfBirth'],FILTER_SANITIZE_STRING));
$gender= trim(filter_var($_POST['gender'],FILTER_SANITIZE_STRING));
$User ID= trim(filter_var($_POST['User ID'],FILTER_SANITIZE_STRING));

$patient = new Patient();
try{
    $savedPatient = $patient->savePatient($id,$name,$dateOfBirth,$gender,$User ID);
    if($savedPatient == null){
        exit(json_encode( 
            array(
            "status"=>"failed",
            "message"=>"Failed to add Patient"
        )
        ));
      }
    exit(json_encode(
        array(
            "status"=>"success",
            "message"=>"Patient added successfully"
         )
    ));
}
catch(Exception $ex){
exit(json_encode(
  array(
  "status"=>"failed",
  "message"=>"Failed to add Patient"
)
));
}
