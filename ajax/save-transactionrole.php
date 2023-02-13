<?php
 include('../classes/database.php');
 include('../classes/transactionrole'.php);

$id= trim(filter_var($_POST['id'],FILTER_SANITIZE_STRING));
$name = trim(filter_var($_POST['name '],FILTER_SANITIZE_STRING));
$description= trim(filter_var($_POST['description'],FILTER_SANITIZE_STRING));

$transactionRole = new TransactionRole();
try{
    $savedTransactionRole = $transactionRole->saveTransactionRole($id,$name ,$description);
    if($savedTransactionRole == null){
        exit(json_encode( 
            array(
            "status"=>"failed",
            "message"=>"Failed to add Transaction&nbsp;Role"
        )
        ));
      }
    exit(json_encode(
        array(
            "status"=>"success",
            "message"=>"Transaction&nbsp;Role added successfully"
         )
    ));
}
catch(Exception $ex){
exit(json_encode(
  array(
  "status"=>"failed",
  "message"=>"Failed to add Transaction&nbsp;Role"
)
));
}
