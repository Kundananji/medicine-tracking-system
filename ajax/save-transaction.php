<?php
 include('../classes/database.php');
 include('../classes/transaction'.php);

$id= trim(filter_var($_POST['id'],FILTER_SANITIZE_STRING));
$dateOfTransaction= trim(filter_var($_POST['dateOfTransaction'],FILTER_SANITIZE_STRING));
$details= trim(filter_var($_POST['details'],FILTER_SANITIZE_STRING));
$location= trim(filter_var($_POST['location'],FILTER_SANITIZE_STRING));
$transactionTypeId= trim(filter_var($_POST['transactionTypeId'],FILTER_SANITIZE_STRING));

$transaction = new Transaction();
try{
    $savedTransaction = $transaction->saveTransaction($id,$dateOfTransaction,$details,$location,$transactionTypeId);
    if($savedTransaction == null){
        exit(json_encode( 
            array(
            "status"=>"failed",
            "message"=>"Failed to add Transaction"
        )
        ));
      }
    exit(json_encode(
        array(
            "status"=>"success",
            "message"=>"Transaction added successfully"
         )
    ));
}
catch(Exception $ex){
exit(json_encode(
  array(
  "status"=>"failed",
  "message"=>"Failed to add Transaction"
)
));
}
