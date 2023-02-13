<?php
 include('../classes/database.php');
 include('../classes/salenotification.php'); 
 include('../classes/salenotificationmedicine.php');

$id= trim(filter_var($_POST['id'],FILTER_SANITIZE_STRING));
$dateOfSale= trim(filter_var($_POST['dateOfSale'],FILTER_SANITIZE_STRING));
$buyerId= trim(filter_var($_POST['buyerId'],FILTER_SANITIZE_STRING));
$sellerId= trim(filter_var($_POST['sellerId'],FILTER_SANITIZE_STRING));
$location= trim(filter_var($_POST['location'],FILTER_SANITIZE_STRING));
$medicines = $_POST['medicines'];

print_r($_POST);

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
   $saleNotificationMedicine = new SaleNotificationMedicine();
   foreach($medicines as $medicine){


      $id= trim(filter_var($medicine['id'],FILTER_SANITIZE_STRING));
      $saleNotificationId= trim(filter_var($medicine['saleNotificationId'],FILTER_SANITIZE_STRING));
      $medicineId= trim(filter_var($medicine['medicineId'],FILTER_SANITIZE_STRING));
      $quantity= trim(filter_var($medicine['quantity'],FILTER_SANITIZE_STRING));
      $amount= trim(filter_var($medicine['amount'],FILTER_SANITIZE_STRING));


      $saleNotificationMedicine->saveSaleNotificationMedicine($id,$saleNotificationId,$medicineId,$quantity,$amount);
      if($savedSaleNotificationMedicine == null){
        //failed to save
      }
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
