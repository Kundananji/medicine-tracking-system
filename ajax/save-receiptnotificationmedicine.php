<?php
 include('../classes/database.php');
 include('../classes/receiptnotificationmedicine'.php);

$id= trim(filter_var($_POST['id'],FILTER_SANITIZE_STRING));
$receiptNotificationId= trim(filter_var($_POST['receiptNotificationId'],FILTER_SANITIZE_STRING));
$medicineId= trim(filter_var($_POST['medicineId'],FILTER_SANITIZE_STRING));
$quantity= trim(filter_var($_POST['quantity'],FILTER_SANITIZE_STRING));
$amount= trim(filter_var($_POST['amount'],FILTER_SANITIZE_STRING));

$receiptNotificationMedicine = new ReceiptNotificationMedicine();
try{
    $savedReceiptNotificationMedicine = $receiptNotificationMedicine->saveReceiptNotificationMedicine($id,$receiptNotificationId,$medicineId,$quantity,$amount);
    if($savedReceiptNotificationMedicine == null){
        exit(json_encode( 
            array(
            "status"=>"failed",
            "message"=>"Failed to add Receipt&nbsp;Notification&nbsp;Medicine"
        )
        ));
      }
    exit(json_encode(
        array(
            "status"=>"success",
            "message"=>"Receipt&nbsp;Notification&nbsp;Medicine added successfully"
         )
    ));
}
catch(Exception $ex){
exit(json_encode(
  array(
  "status"=>"failed",
  "message"=>"Failed to add Receipt&nbsp;Notification&nbsp;Medicine"
)
));
}
