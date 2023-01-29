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
    
$editedMedicine = $medicine->editMedicine($name,$description,$manufacturedDate,$expiryDate,$gtin,$serialNumber,$lotNumber,$packageDetails,$manufacturerId,$id);

if($editedMedicine == null){
    exit(json_encode(
        array(
            "status"=>"failed",
            "message"=>"Failed to edit medicine"
        )
        ));
};

exit(json_encode(
    array(
        "status"=>"success",
        "message"=>"Medicine edited successfully"
    )
    ));
}
catch(Exception $ex){
    exit(json_encode(
        array(
            "status"=>"failed",
            "message"=>"Failed to edit medicine"
        )
        ));
}


