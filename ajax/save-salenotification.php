<?php
include('../classes/database.php');
include('../classes/user.php');
include('../classes/salenotification.php');
include('../classes/salenotificationmedicine.php');
include('../classes/transaction.php');
include('../classes/transactionactor.php');
include('../classes/transactionmedicine.php');
include('../classes/transactionrole.php');
include('../classes/typeoftransaction.php');
include('../classes/blockchain.php');
include('../classes/block.php');

$id = trim(htmlspecialchars($_POST['id']));
$dateOfSale = trim(htmlspecialchars($_POST['dateOfSale']));
$buyerId = trim(htmlspecialchars($_POST['buyerId']));
$sellerId = trim(htmlspecialchars($_POST['sellerId']));
$location = trim(htmlspecialchars($_POST['location']));
$medicines = $_POST['medicines'];

//to do: add validation
if(empty($dateOfSale)){
  exit(json_encode(
    array(
      "status" => "failed",
      "message" => "Date of Sale is missing"
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

$saleNotification = new SaleNotification();
Database::getConnection()->query("SET autocommit=0;");
try {
  //begin transaction
  Database::getConnection()->query("START TRANSACTION;");
  $savedSaleNotification = $saleNotification->saveSaleNotification($id, $dateOfSale, $buyerId, $sellerId, $location);
  if ($savedSaleNotification == null) {

    //roll back whatever has been done
    Database::getConnection()->query("ROLLBACK;");
    exit(json_encode(
      array(
        "status" => "failed",
        "message" => "Failed to add Sale Notification"
      )
    ));
  }

  $saleNotificationMedicine = new SaleNotificationMedicine();

  $failed = 0;
  for ($i = 0 ; $i< sizeof($medicines); $i++ ) {
    $medicine = $medicines[$i];
    $id = 0;
    
    $saleNotificationId = $savedSaleNotification->getId();
      
    $medicineId = trim(htmlspecialchars($medicine['id']));
    $medicine['details']="medicine details";
    
    if($medicineId==null){
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
    
    if(isset($medicine['quantity'])){
      $quantity = trim(htmlspecialchars($medicine['quantity']));
    }
    else{
      $medicine['quantity']=$quantity;
    }

    if($quantity===""){
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
    if($amount===""){
      //roll back whatever has been done
      Database::getConnection()->query("ROLLBACK;");
         exit(json_encode(
           array(
             "status" => "failed",
             "message" => "Quantity is missing"
           )
         ));
     };

    $savedSaleNotificationMedicine =$saleNotificationMedicine->saveSaleNotificationMedicine($id, $saleNotificationId, $medicineId, $quantity, $amount);
    if ($savedSaleNotificationMedicine == null) {
      //failed to save
      $failed += 1;
    }
    $medicines[$i]=$medicine; //update medicine on array
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
  $transactionType="Sale";
  $dateOfTransaction=date("Y-m-d");
  $actors = [
     array("userId"=>$buyerId,"roleName"=>"Buyer"),
     array("userId"=>$sellerId,"roleName"=>"Seller"),
  ];

  $details="Sale of Medicine";

  $transaction = new Transaction();
  $transaction->createTransaction($dateOfTransaction,
                                  $details,
                                  $location,
                                  $transactionType, 
                                  $actors,
                                  $medicines);

  //commit, everything okay
  Database::getConnection()->query("COMMIT;");

  exit(json_encode(
    array(
      "status" => "success",
      "message" => "Sale Notification added successfully"
    )
  ));
} catch (Exception $ex) {
  print_r($ex);
  //roll back whatever has been done
  Database::getConnection()->query("ROLLBACK;");
  exit(json_encode(
    array(
      "status" => "failed",
      "message" => "Failed to add Sale Notification"
    )
  ));
}
