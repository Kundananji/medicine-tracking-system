<?php
 include('../classes/database.php');
 include('../classes/salenotification.php');

$id= trim(filter_var($_POST['id'],FILTER_SANITIZE_STRING));
$dateOfSale= trim(filter_var($_POST['dateOfSale'],FILTER_SANITIZE_STRING));
$buyerId= trim(filter_var($_POST['buyerId'],FILTER_SANITIZE_STRING));
$sellerId= trim(filter_var($_POST['sellerId'],FILTER_SANITIZE_STRING));
$location= trim(filter_var($_POST['location'],FILTER_SANITIZE_STRING));

$saleNotification = new SaleNotification();
try{
    $savedSaleNotification = $saleNotification->saveSaleNotification($id,$dateOfSale,$buyerId,$sellerId,$location);
    if($savedSaleNotification == null){
        exit(json_encode( 
            array(
            "status"=>"failed",
            "message"=>"Failed to add Sale&nbsp;Notification"
        )
        ));
      }
    exit(json_encode(
        array(
            "status"=>"success",
            "message"=>"Sale&nbsp;Notification added successfully"
         )
    ));
}
catch(Exception $ex){
  print_r($ex);
exit(json_encode(
  array(
  "status"=>"failed",
  "message"=>"Failed to add Sale&nbsp;Notification"
)
));
}
