<?php
 include('../classes/database.php');
 include('../classes/medicine.php');
 include('../classes/user.php');

$id= trim(filter_var($_POST['id'],FILTER_SANITIZE_STRING));
$name= trim(filter_var($_POST['name'],FILTER_SANITIZE_STRING));
$description= trim(filter_var($_POST['description'],FILTER_SANITIZE_STRING));
$manufacturedDate= trim(filter_var($_POST['manufacturedDate'],FILTER_SANITIZE_STRING));
$expiryDate= trim(filter_var($_POST['expiryDate'],FILTER_SANITIZE_STRING));
$gtin= trim(filter_var($_POST['gtin'],FILTER_SANITIZE_STRING));
$serialNumber= trim(filter_var($_POST['serialNumber'],FILTER_SANITIZE_STRING));
$lotNumber= trim(filter_var($_POST['lotNumber'],FILTER_SANITIZE_STRING));
$packageDetails= trim(filter_var($_POST['packageDetails'],FILTER_SANITIZE_STRING));
$manufacturerId= trim(filter_var($_POST['manufacturerId'],FILTER_SANITIZE_STRING));

$medicine = new Medicine();
try{
    $savedMedicine = $medicine->saveMedicine($id,$name,$description,$manufacturedDate,$expiryDate,$gtin,$serialNumber,$lotNumber,$packageDetails,$manufacturerId);
    if($savedMedicine == null){
        exit(json_encode( 
            array(
            "status"=>"failed",
            "message"=>"Failed to add Medicine"
        )
        ));
      }
    exit(json_encode(
        array(
            "status"=>"success",
            "message"=>"Medicine added successfully"
         )
    ));
}
catch(Exception $ex){
  //print_r($ex);
exit(json_encode(
  array(
  "status"=>"failed",
  "message"=>"Failed to add Medicine"
)
));
}
