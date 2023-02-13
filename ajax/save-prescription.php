<?php
 include('../classes/database.php');
 include('../classes/prescription'.php);

$id= trim(filter_var($_POST['id'],FILTER_SANITIZE_STRING));
$prescriptionDate= trim(filter_var($_POST['prescriptionDate'],FILTER_SANITIZE_STRING));
$hospitalId= trim(filter_var($_POST['hospitalId'],FILTER_SANITIZE_STRING));
$patientId= trim(filter_var($_POST['patientId'],FILTER_SANITIZE_STRING));

$prescription = new Prescription();
try{
    $savedPrescription = $prescription->savePrescription($id,$prescriptionDate,$hospitalId,$patientId);
    if($savedPrescription == null){
        exit(json_encode( 
            array(
            "status"=>"failed",
            "message"=>"Failed to add Prescription"
        )
        ));
      }
    exit(json_encode(
        array(
            "status"=>"success",
            "message"=>"Prescription added successfully"
         )
    ));
}
catch(Exception $ex){
exit(json_encode(
  array(
  "status"=>"failed",
  "message"=>"Failed to add Prescription"
)
));
}
