<?php
 include('../classes/database.php');
 include('../classes/transactionactor'.php);

$id= trim(filter_var($_POST['id'],FILTER_SANITIZE_STRING));
$userId = trim(filter_var($_POST['userId '],FILTER_SANITIZE_STRING));
$transactionRoleId= trim(filter_var($_POST['transactionRoleId'],FILTER_SANITIZE_STRING));

$transactionActor = new TransactionActor();
try{
    $savedTransactionActor = $transactionActor->saveTransactionActor($id,$userId ,$transactionRoleId);
    if($savedTransactionActor == null){
        exit(json_encode( 
            array(
            "status"=>"failed",
            "message"=>"Failed to add Transaction&nbsp;Actor"
        )
        ));
      }
    exit(json_encode(
        array(
            "status"=>"success",
            "message"=>"Transaction&nbsp;Actor added successfully"
         )
    ));
}
catch(Exception $ex){
exit(json_encode(
  array(
  "status"=>"failed",
  "message"=>"Failed to add Transaction&nbsp;Actor"
)
));
}
