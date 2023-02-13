<?php
 include('../classes/database.php');
 include('../classes/salenotificationmedicine.php');

$id= trim(filter_var($_POST['id'],FILTER_SANITIZE_STRING));
$saleNotificationId= trim(filter_var($_POST['saleNotificationId'],FILTER_SANITIZE_STRING));
$medicineId= trim(filter_var($_POST['medicineId'],FILTER_SANITIZE_STRING));
$quantity= trim(filter_var($_POST['quantity'],FILTER_SANITIZE_STRING));
$amount= trim(filter_var($_POST['amount'],FILTER_SANITIZE_STRING));

$saleNotificationMedicine = new SaleNotificationMedicine();
try{
    $savedSaleNotificationMedicine = $saleNotificationMedicine->saveSaleNotificationMedicine($id,$saleNotificationId,$medicineId,$quantity,$amount);
    if($savedSaleNotificationMedicine == null){
        exit(json_encode( 
            array(
            "status"=>"failed",
            "message"=>"Failed to add Sale&nbsp;Notification&nbsp;Medicine"
        )
        ));
      }
    



    exit(json_encode(
        array(
            "status"=>"success",
            "message"=>"Sale&nbsp;Notification&nbsp;Medicine added successfully"
         )
    ));
}
catch(Exception $ex){
exit(json_encode(
  array(
  "status"=>"failed",
  "message"=>"Failed to add Sale&nbsp;Notification&nbsp;Medicine"
)
));
}
