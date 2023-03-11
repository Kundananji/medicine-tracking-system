<?php
include('../classes/database.php');
include('../classes/user.php');
include('../classes/receiptnotification.php');
include('../classes/receiptnotificationmedicine.php');
include('../classes/transaction.php');
include('../classes/transactionactor.php');
include('../classes/transactionmedicine.php');
include('../classes/transactionrole.php');
include('../classes/typeoftransaction.php');
include('../classes/blockchain.php');
include('../classes/block.php');

$id = trim(filter_var($_POST['id'], FILTER_SANITIZE_STRING));
$dateOfReceipt = trim(filter_var($_POST['dateOfReceipt'], FILTER_SANITIZE_STRING));
$buyerId = trim(filter_var($_POST['buyerId'], FILTER_SANITIZE_STRING));
$sellerId = trim(filter_var($_POST['sellerId'], FILTER_SANITIZE_STRING));
$location = trim(filter_var($_POST['location'], FILTER_SANITIZE_STRING));
$medicines = $_POST['medicines'];

//perform validation
if(empty($dateOfReceipt)){
  exit(json_encode(
    array(
      "status" => "failed",
      "message" => "Date of Receipt is missing"
    )
  ));
}

if(empty($buyerId)){
  exit(json_encode(
    array(
      "status" => "failed",
      "message" => "Buyer is missing"
    )
  ));
}

if(empty($sellerId)){
  exit(json_encode(
    array(
      "status" => "failed",
      "message" => "Seller is missing"
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

$receiptNotification = new ReceiptNotification();
Database::getConnection()->query("SET autocommit=0;");
try {
  //begin transaction
  Database::getConnection()->query("START TRANSACTION;");
  $savedReceiptNotification = $receiptNotification->saveReceiptNotification($id, $dateOfReceipt, $buyerId, $sellerId, $location);
  if ($savedReceiptNotification == null) {
    //roll back whatever has been done
    Database::getConnection()->query("ROLLBACK;");
    exit(json_encode(
      array(
        "status" => "failed",
        "message" => "Failed to add Receipt&nbsp;Notification"
      )
    ));
  }

  //save notification transaction

  $receiptNotificationMedicine = new receiptNotificationMedicine();

  $failed = 0;
  for ($i = 0; $i < sizeof($medicines); $i++) {
    $medicine = $medicines[$i];
    $id = 0;

    $receiptNotificationId = $savedReceiptNotification->getId();

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
    $amount = trim(htmlspecialchars($medicine['amount']));
    if ($amount === "") {
      //roll back whatever has been done
      Database::getConnection()->query("ROLLBACK;");
      exit(json_encode(
        array(
          "status" => "failed",
          "message" => "Amount is missing"
        )
      ));
    };

    $savedReceiptNotificationMedicine = $receiptNotificationMedicine->saveReceiptNotificationMedicine($id, $saleNotificationId, $medicineId, $quantity, $amount);
    if ($savedReceiptNotificationMedicine == null) {
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
        "message" => "Failed to add Sale Notification. Some medicines could be be added"
      )
    ));
  }

  //at this point, we can create the transction that will be shared with blockchain network
  $transactionType = "Sale";
  $dateOfTransaction = date("Y-m-d");
  $actors = [
    array("userId" => $buyerId, "roleName" => "Buyer"),
    array("userId" => $sellerId, "roleName" => "Seller"),
  ];

  $details = "Receipt of Medicine";

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
      "message" => "Receipt&nbsp;Notification added successfully"
    )
  ));
} catch (Exception $ex) {
  //roll back whatever has been done
  Database::getConnection()->query("ROLLBACK;");
  exit(json_encode(
    array(
      "status" => "failed",
      "message" => "Failed to add Receipt&nbsp;Notification"
    )
  ));
}
