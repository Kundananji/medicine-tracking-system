<?php
 include('../classes/database.php');
 include('../classes/deliverynotification'.php);

$id= trim(filter_var($_POST['id'],FILTER_SANITIZE_STRING));
$dateOfDelivery= trim(filter_var($_POST['dateOfDelivery'],FILTER_SANITIZE_STRING));
$deliveredById= trim(filter_var($_POST['deliveredById'],FILTER_SANITIZE_STRING));
$deliveredToId= trim(filter_var($_POST['deliveredToId'],FILTER_SANITIZE_STRING));
$location= trim(filter_var($_POST['location'],FILTER_SANITIZE_STRING));

$deliveryNotification = new DeliveryNotification();
try{
    $savedDeliveryNotification = $deliveryNotification->saveDeliveryNotification($id,$dateOfDelivery,$deliveredById,$deliveredToId,$location);
    if($savedDeliveryNotification == null){
        exit(json_encode( 
            array(
            "status"=>"failed",
            "message"=>"Failed to add Delivery&nbsp;Notification"
        )
        ));
      }
    exit(json_encode(
        array(
            "status"=>"success",
            "message"=>"Delivery&nbsp;Notification added successfully"
         )
    ));
}
catch(Exception $ex){
exit(json_encode(
  array(
  "status"=>"failed",
  "message"=>"Failed to add Delivery&nbsp;Notification"
)
));
}
