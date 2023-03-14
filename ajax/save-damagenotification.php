<?php
session_start();
include('../classes/database.php');
include('../classes/user.php');
include('../classes/damagenotification.php');
include('../classes/damagenotificationmedicine.php');
include('../classes/transaction.php');
include('../classes/transactionactor.php');
include('../classes/transactionmedicine.php');
include('../classes/transactionrole.php');
include('../classes/typeoftransaction.php');
include('../classes/blockchain.php');
include('../classes/block.php');

$id = trim(filter_var($_POST['id'], FILTER_SANITIZE_STRING));
$dateOfNotification = trim(filter_var($_POST['dateOfNotification'], FILTER_SANITIZE_STRING));
$reportedbyId = trim(filter_var($_POST['reportedbyId'], FILTER_SANITIZE_STRING));
$details = trim(filter_var($_POST['details'], FILTER_SANITIZE_STRING));
$location = trim(filter_var($_POST['location'], FILTER_SANITIZE_STRING));
$medicines = $_POST['medicines'];

//perform validation
if (empty($dateOfNotification)) {
  exit(json_encode(
    array(
      "status" => "failed",
      "message" => "Date of Notification is missing"
    )
  ));
}

if (empty($reportedbyId)) {
  exit(json_encode(
    array(
      "status" => "failed",
      "message" => "Reporter is missing"
    )
  ));
}



if (empty($location)) {
  exit(json_encode(
    array(
      "status" => "failed",
      "message" => "Location is missing"
    )
  ));
}

if (sizeof($medicines) == 0) {
  exit(json_encode(
    array(
      "status" => "failed",
      "message" => "Medicines are missing"
    )
  ));
}
$damageNotification = new DamageNotification();
Database::getConnection()->query("SET autocommit=0;");
try {
  //begin transaction
  Database::getConnection()->query("START TRANSACTION;");
  $savedDamageNotification = $damageNotification->saveDamageNotification($id, $dateOfNotification, $reportedbyId, $details, $location);
  if ($savedDamageNotification == null) {
    //roll back whatever has been done
    Database::getConnection()->query("ROLLBACK;");
    exit(json_encode(
      array(
        "status" => "failed",
        "message" => "Failed to add Damage&nbsp;Notification"
      )
    ));
  }

 //save damage notification transaction
 $damageNotificationMedicine = new DamageNotificationMedicine();

 $failed = 0;
 for ($i = 0; $i < sizeof($medicines); $i++) {
   $medicine = $medicines[$i];
   $id = 0;

   $damageNotificationId = $savedDamageNotification->getId();

   $medicineId = trim(htmlspecialchars($medicine['id']));
 
 

   if ($medicineId == null) {
     //roll back whatever has been done
     Database::getConnection()->query("ROLLBACK;");
     exit(json_encode(
       array(
         "status" => "failed",
         "message" => "Medicine Id is missing"
       )
     ));
   };

   $quantity = 1;
   //to: update medicine quantity if necessary  

   if (isset($medicine['quantity'])) {
     $quantity = trim(htmlspecialchars($medicine['quantity']));
   } else {
     $medicine['quantity'] = $quantity;
   }

   if ($quantity === "") {
     //roll back whatever has been done
     Database::getConnection()->query("ROLLBACK;");
     exit(json_encode(
       array(
         "status" => "failed",
         "message" => "Quantity is missing"
       )
     ));
   };
   
  

   $details = $medicine['damageDetails'];

   if ($details === "") {
     //roll back whatever has been done
     Database::getConnection()->query("ROLLBACK;");
     exit(json_encode(
       array(
         "status" => "failed",
         "message" => "Damage details are missing"
       )
     ));
   };

   $medicine['details'] = $details;

   $savedDamageNotificationMedicine = $damageNotificationMedicine->saveDamageNotificationMedicine($id, $damageNotificationId, $medicineId, $quantity,$details);
   if ($savedDamageNotificationMedicine == null) {
     //failed to save
     $failed += 1;
   }
   $medicines[$i] = $medicine; //update medicine on array
 }

 // print_r($medicines);

 if ($failed > 0) {

   //roll back whatever has been done
   Database::getConnection()->query("ROLLBACK;");
   exit(json_encode(
     array(
       "status" => "failed",
       "message" => "Failed to add delivery Notification. Some medicines could be be added"
     )
   ));
 }

 //at this point, we can create the transction that will be shared with blockchain network
 $transactionType = "Delivery";
 $dateOfTransaction = date("Y-m-d");
 $actors = [
   array("userId" => $reportedbyId, "roleName" => "Reporter")
 ];

 $details = "Delivery of Medicine";

 $transaction = new Transaction();
 $transaction->createTransaction(
   $dateOfTransaction,
   $details,
   $location,
   $transactionType,
   $actors,
   $medicines
 );



 //commit, everything okay
 Database::getConnection()->query("COMMIT;");
 //end notification transaction









  exit(json_encode(
    array(
      "status" => "success",
      "message" => "Damage Notification added successfully"
    )
  ));
} catch (Exception $ex) {
  print_r($ex);
  //roll back whatever has been done
  Database::getConnection()->query("ROLLBACK;");
  exit(json_encode(
    array(
      "status" => "failed",
      "message" => "Failed to add Damage&nbsp;Notification"
    )
  ));
}
