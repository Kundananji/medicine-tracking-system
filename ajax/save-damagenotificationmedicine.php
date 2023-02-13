<?php
 include('../classes/database.php');
 include('../classes/damagenotificationmedicine'.php);

$id= trim(filter_var($_POST['id'],FILTER_SANITIZE_STRING));
$damageNotificationId= trim(filter_var($_POST['damageNotificationId'],FILTER_SANITIZE_STRING));
$medicineId= trim(filter_var($_POST['medicineId'],FILTER_SANITIZE_STRING));
$quantity= trim(filter_var($_POST['quantity'],FILTER_SANITIZE_STRING));
$amount= trim(filter_var($_POST['amount'],FILTER_SANITIZE_STRING));
$details= trim(filter_var($_POST['details'],FILTER_SANITIZE_STRING));

$damageNotificationMedicine = new DamageNotificationMedicine();
try{
    $savedDamageNotificationMedicine = $damageNotificationMedicine->saveDamageNotificationMedicine($id,$damageNotificationId,$medicineId,$quantity,$amount,$details);
    if($savedDamageNotificationMedicine == null){
        exit(json_encode( 
            array(
            "status"=>"failed",
            "message"=>"Failed to add Damage&nbsp;Notification&nbsp;Medicine"
        )
        ));
      }
    exit(json_encode(
        array(
            "status"=>"success",
            "message"=>"Damage&nbsp;Notification&nbsp;Medicine added successfully"
         )
    ));
}
catch(Exception $ex){
exit(json_encode(
  array(
  "status"=>"failed",
  "message"=>"Failed to add Damage&nbsp;Notification&nbsp;Medicine"
)
));
}
