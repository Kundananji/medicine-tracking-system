<?php
 include('../classes/database.php');
 include('../classes/damagenotification'.php);

$id= trim(filter_var($_POST['id'],FILTER_SANITIZE_STRING));
$dateOfNotification= trim(filter_var($_POST['dateOfNotification'],FILTER_SANITIZE_STRING));
$reportedbyId= trim(filter_var($_POST['reportedbyId'],FILTER_SANITIZE_STRING));
$details= trim(filter_var($_POST['details'],FILTER_SANITIZE_STRING));
$location= trim(filter_var($_POST['location'],FILTER_SANITIZE_STRING));

$damageNotification = new DamageNotification();
try{
    $savedDamageNotification = $damageNotification->saveDamageNotification($id,$dateOfNotification,$reportedbyId,$details,$location);
    if($savedDamageNotification == null){
        exit(json_encode( 
            array(
            "status"=>"failed",
            "message"=>"Failed to add Damage&nbsp;Notification"
        )
        ));
      }
    exit(json_encode(
        array(
            "status"=>"success",
            "message"=>"Damage&nbsp;Notification added successfully"
         )
    ));
}
catch(Exception $ex){
exit(json_encode(
  array(
  "status"=>"failed",
  "message"=>"Failed to add Damage&nbsp;Notification"
)
));
}
