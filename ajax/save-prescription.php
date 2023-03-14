<?php
include('../classes/database.php');
include('../classes/user.php');
include('../classes/prescription.php');
include('../classes/prescriptionmedicine.php');
include('../classes/transaction.php');
include('../classes/transactionactor.php');
include('../classes/transactionmedicine.php');
include('../classes/transactionrole.php');
include('../classes/typeoftransaction.php');
include('../classes/blockchain.php');
include('../classes/block.php');

$id = trim(filter_var($_POST['id'], FILTER_SANITIZE_STRING));
$prescriptionDate = trim(filter_var($_POST['prescriptionDate'], FILTER_SANITIZE_STRING));
$hospitalId = trim(filter_var($_POST['hospitalId'], FILTER_SANITIZE_STRING));
$patientId = trim(filter_var($_POST['patientId'], FILTER_SANITIZE_STRING));
$location = trim(filter_var($_POST['location'], FILTER_SANITIZE_STRING));
$medicines = $_POST['medicines'];

$prescription = new Prescription();

//perform validation
if (empty($prescriptionDate)) {
  exit(json_encode(
    array(
      "status" => "failed",
      "message" => "Date of Prescription is missing"
    )
  ));
}

if (empty($patientId)) {
  exit(json_encode(
    array(
      "status" => "failed",
      "message" => "Pateient Id is missing"
    )
  ));
}

if (empty($hospitalId)) {
  exit(json_encode(
    array(
      "status" => "failed",
      "message" => "Hospital Id is missing"
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
Database::getConnection()->query("SET autocommit=0;");
try {
  //begin transaction
  Database::getConnection()->query("START TRANSACTION;");
  $savedPrescription = $prescription->savePrescription($id, $prescriptionDate, $hospitalId, $patientId, $location);
  if ($savedPrescription == null) {
    //roll back whatever has been done
    Database::getConnection()->query("ROLLBACK;");
    exit(json_encode(
      array(
        "status" => "failed",
        "message" => "Failed to add Prescription"
      )
    ));
  }


  //save notification transaction

  $prescriptionMedicine = new PrescriptionMedicine();

  $failed = 0;
  for ($i = 0; $i < sizeof($medicines); $i++) {
    $medicine = $medicines[$i];
    $id = 0;

    $prescriptionId = $savedPrescription->getId();

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
    $dosage = trim(htmlspecialchars($medicine['dosage']));
    $amount = 0;

    if ($dosage === "") {
      //roll back whatever has been done
      Database::getConnection()->query("ROLLBACK;");
      exit(json_encode(
        array(
          "status" => "failed",
          "message" => "Dosage is missing"
        )
      ));
    };
 

    $savedPrescriptionMedicine = $prescriptionMedicine->savePrescriptionMedicine($id,$prescriptionId,$medicineId,$quantity,$dosage);
    if ($savedPrescriptionMedicine == null) {
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
        "message" => "Failed to add Prescriptin Notification. Some medicines could be be added"
      )
    ));
  }

  //at this point, we can create the transction that will be shared with blockchain network
  $transactionType = "Prescription";
  $dateOfTransaction = date("Y-m-d");
  $actors = [
    array("userId" => $patientId, "roleName" => "Patient"),
    array("userId" => $hospitalId, "roleName" => "Prescriber"),
  ];

  $details = "Dispensation of Medicine";

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
      "message" => "Prescription added successfully"
    )
  ));
} catch (Exception $ex) {
  print_r($ex);
  //roll back whatever has been done
  Database::getConnection()->query("ROLLBACK;");
  exit(json_encode(
    array(
      "status" => "failed",
      "message" => "Failed to add Prescription"
    )
  ));
}
