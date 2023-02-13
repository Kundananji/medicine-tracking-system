<?php
 include('../classes/database.php');
 include('../classes/transactionmedicine'.php);

$id= trim(filter_var($_POST['id'],FILTER_SANITIZE_STRING));
$transactionId= trim(filter_var($_POST['transactionId'],FILTER_SANITIZE_STRING));
$medicineId= trim(filter_var($_POST['medicineId'],FILTER_SANITIZE_STRING));
$details= trim(filter_var($_POST['details'],FILTER_SANITIZE_STRING));
$quantity= trim(filter_var($_POST['quantity'],FILTER_SANITIZE_STRING));
$amount= trim(filter_var($_POST['amount'],FILTER_SANITIZE_STRING));

$transactionMedicine = new TransactionMedicine();
try{
    $savedTransactionMedicine = $transactionMedicine->saveTransactionMedicine($id,$transactionId,$medicineId,$details,$quantity,$amount);
    if($savedTransactionMedicine == null){
        exit(json_encode( 
            array(
            "status"=>"failed",
            "message"=>"Failed to add Transaction&nbsp;Medicine"
        )
        ));
      }
    exit(json_encode(
        array(
            "status"=>"success",
            "message"=>"Transaction&nbsp;Medicine added successfully"
         )
    ));
}
catch(Exception $ex){
exit(json_encode(
  array(
  "status"=>"failed",
  "message"=>"Failed to add Transaction&nbsp;Medicine"
)
));
}
