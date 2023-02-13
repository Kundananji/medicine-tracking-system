<?php
 include('../classes/database.php');
 include('../classes/receiptnotification'.php);

$id= trim(filter_var($_POST['id'],FILTER_SANITIZE_STRING));
$dateOfReceipt= trim(filter_var($_POST['dateOfReceipt'],FILTER_SANITIZE_STRING));
$buyerId= trim(filter_var($_POST['buyerId'],FILTER_SANITIZE_STRING));
$sellerId= trim(filter_var($_POST['sellerId'],FILTER_SANITIZE_STRING));
$location= trim(filter_var($_POST['location'],FILTER_SANITIZE_STRING));

$receiptNotification = new ReceiptNotification();
try{
    $savedReceiptNotification = $receiptNotification->saveReceiptNotification($id,$dateOfReceipt,$buyerId,$sellerId,$location);
    if($savedReceiptNotification == null){
        exit(json_encode( 
            array(
            "status"=>"failed",
            "message"=>"Failed to add Receipt&nbsp;Notification"
        )
        ));
      }
    exit(json_encode(
        array(
            "status"=>"success",
            "message"=>"Receipt&nbsp;Notification added successfully"
         )
    ));
}
catch(Exception $ex){
exit(json_encode(
  array(
  "status"=>"failed",
  "message"=>"Failed to add Receipt&nbsp;Notification"
)
));
}
