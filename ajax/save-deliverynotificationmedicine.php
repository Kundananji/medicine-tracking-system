<?php
 include('../classes/database.php');
 include('../classes/deliverynotificationmedicine'.php);

$id= trim(filter_var($_POST['id'],FILTER_SANITIZE_STRING));
$deliveryNotificationId= trim(filter_var($_POST['deliveryNotificationId'],FILTER_SANITIZE_STRING));
$medicineId= trim(filter_var($_POST['medicineId'],FILTER_SANITIZE_STRING));
$quantity= trim(filter_var($_POST['quantity'],FILTER_SANITIZE_STRING));
$amount= trim(filter_var($_POST['amount'],FILTER_SANITIZE_STRING));

$deliveryNotificationMedicine = new DeliveryNotificationMedicine();
try{
    $savedDeliveryNotificationMedicine = $deliveryNotificationMedicine->saveDeliveryNotificationMedicine($id,$deliveryNotificationId,$medicineId,$quantity,$amount);
    if($savedDeliveryNotificationMedicine == null){
        exit(json_encode( 
            array(
            "status"=>"failed",
            "message"=>"Failed to add Delivery&nbsp;Notification&nbsp;Medicine"
        )
        ));
      }
    exit(json_encode(
        array(
            "status"=>"success",
            "message"=>"Delivery&nbsp;Notification&nbsp;Medicine added successfully"
         )
    ));
}
catch(Exception $ex){
exit(json_encode(
  array(
  "status"=>"failed",
  "message"=>"Failed to add Delivery&nbsp;Notification&nbsp;Medicine"
)
));
}
