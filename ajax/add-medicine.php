<?php

include('classes/database.php');
include('classes/medicine.php');

$id=trim($_POST['id']); 
$name=trim($_POST['name']); 
$description=trim($_POST['description']); 
$manufacturedDate=trim($_POST['manufacturedDate']); 
$expiryDate=trim($_POST['expiryDate']); 
$gtin=trim($_POST['gtin']); 
$serialNumber=trim($_POST['serialNumber']); 
$lotNumber=trim($_POST['lotNumber']); 
$packageDetails=trim($_POST['packageDetails']); 
$manufacturerId=trim($_POST['manufacturerId']);

$medicine = new Medicine();
try{
$addedMedicine = $medicine->addMedicine($name,$description,$manufacturedDate,$expiryDate,$gtin,$serialNumber,$lotNumber,$packageDetails,$manufacturerId);

if($addedMedicine == null){
    exit(json_encode(
        array(
            "status"=>"failed",
            "message"=>"Failed to add medicine"
        )
        ));
};

exit(json_encode(
    array(
        "status"=>"success",
        "message"=>"Medicine added successfully"
    )
    ));
}
catch(Exception $ex){
    exit(json_encode(
        array(
            "status"=>"failed",
            "message"=>"Failed to add medicine"
        )
        ));
}


