<?php
 include('../classes/database.php');
 include('../classes/typeoftransaction'.php);

$id= trim(filter_var($_POST['id'],FILTER_SANITIZE_STRING));
$name = trim(filter_var($_POST['name '],FILTER_SANITIZE_STRING));
$description= trim(filter_var($_POST['description'],FILTER_SANITIZE_STRING));

$typeOfTransaction = new TypeOfTransaction();
try{
    $savedTypeOfTransaction = $typeOfTransaction->saveTypeOfTransaction($id,$name ,$description);
    if($savedTypeOfTransaction == null){
        exit(json_encode( 
            array(
            "status"=>"failed",
            "message"=>"Failed to add Type&nbsp;Of&nbsp;Transaction"
        )
        ));
      }
    exit(json_encode(
        array(
            "status"=>"success",
            "message"=>"Type&nbsp;Of&nbsp;Transaction added successfully"
         )
    ));
}
catch(Exception $ex){
exit(json_encode(
  array(
  "status"=>"failed",
  "message"=>"Failed to add Type&nbsp;Of&nbsp;Transaction"
)
));
}
