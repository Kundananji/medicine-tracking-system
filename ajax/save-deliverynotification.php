<?php
 include('../classes/database.php');
 include('../classes/user.php');
 include('../classes/deliverynotification.php');
 include('../classes/deliverynotificationmedicine.php');
include('../classes/transaction.php');
include('../classes/transactionactor.php');
include('../classes/transactionmedicine.php');
include('../classes/transactionrole.php');
include('../classes/typeoftransaction.php');
include('../classes/blockchain.php');
include('../classes/block.php');

$id= trim(filter_var($_POST['id'],FILTER_SANITIZE_STRING));
$dateOfDelivery= trim(filter_var($_POST['dateOfDelivery'],FILTER_SANITIZE_STRING));
$deliveredById= trim(filter_var($_POST['deliveredById'],FILTER_SANITIZE_STRING));
$deliveredToId= trim(filter_var($_POST['deliveredToId'],FILTER_SANITIZE_STRING));
$location= trim(filter_var($_POST['location'],FILTER_SANITIZE_STRING));
$medicines = $_POST['medicines'];

//perform validation
if(empty($dateOfDelivery)){
  exit(json_encode(
    array(
      "status" => "failed",
      "message" => "Date of delivery is missing"
    )
  ));
}

if(empty($deliveredToId)){
  exit(json_encode(
    array(
      "status" => "failed",
      "message" => "Receipient is missing"
    )
  ));
}

if(empty($deliveredById)){
  exit(json_encode(
    array(
      "status" => "failed",
      "message" => "Deliverer is missing"
    )
  ));
}

if(empty($location)){
  exit(json_encode(
    array(
      "status" => "failed",
      "message" => "Location is missing"
    )
  ));
}

if(sizeof($medicines)==0){
  exit(json_encode(
    array(
      "status" => "failed",
      "message" => "Medicines are missing"
    )
  ));
}

$deliveryNotification = new DeliveryNotification();
Database::getConnection()->query("SET autocommit=0;");
try{
    //begin transaction
    Database::getConnection()->query("START TRANSACTION;");
    $savedDeliveryNotification = $deliveryNotification->saveDeliveryNotification($id,$dateOfDelivery,$deliveredById,$deliveredToId,$location);
    if($savedDeliveryNotification == null){
    //roll back whatever has been done
    Database::getConnection()->query("ROLLBACK;");
        exit(json_encode( 
            array(
            "status"=>"failed",
            "message"=>"Failed to add Delivery&nbsp;Notification"
        )
        ));
      }

   //save delivery notification transaction
  $deliveryNotificationMedicine = new DeliveryNotificationMedicine();

  $failed = 0;
  for ($i = 0; $i < sizeof($medicines); $i++) {
    $medicine = $medicines[$i];
    $id = 0;

    $deliveryNotificationId = $savedDeliveryNotification->getId();

    $medicineId = trim(htmlspecialchars($medicine['id']));
    $medicine['details'] = "medicine details";
  

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
    
   
    $amount = 0;
    $medicine['amount'] =$amount;
    /*if ($amount === "") {
      //roll back whatever has been done
      Database::getConnection()->query("ROLLBACK;");
      exit(json_encode(
        array(
          "status" => "failed",
          "message" => "Amount is missing"
        )
      ));
    };*/

    $savedDeliveryNotificationMedicine = $deliveryNotificationMedicine->saveDeliveryNotificationMedicine($id, $deliveryNotificationId, $medicineId, $quantity);
    if ($savedDeliveryNotificationMedicine == null) {
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
    array("userId" => $deliveredById, "roleName" => "Deliverer"),
    array("userId" => $deliveredToId, "roleName" => "Receiver"),
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
            "status"=>"success",
            "message"=>"Delivery&nbsp;Notification added successfully"
         )
    ));
}
catch(Exception $ex){
  print_r($ex);
  //roll back whatever has been done
Database::getConnection()->query("ROLLBACK;");
exit(json_encode(
  array(
  "status"=>"failed",
  "message"=>"Failed to add Delivery&nbsp;Notification"
)
));
}
