<?php
 require('../classes/database.php');
 require('../classes/deliverynotificationmedicine.php');
  require("../classes/deliverynotification.php");
  require("../classes/medicine.php");


$deliveryNotificationMedicine = new DeliveryNotificationMedicine();
// fetch all records from database
$records = $deliveryNotificationMedicine->getAllRecords();

if(sizeof($records) == 0){
  exit('<div class="alert alert-warning">No records available.</div>');
}
?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>
            </th>
            <th>
                ID
            </th>
            <th>
                Delivery Notification
            </th>
            <th>
                Medicine
            </th>
            <th>
                Quantity
            </th>
            <th>
                Amount
            </th>
        </tr>
    </thead>
    <tbody>
<?php
    $rowCount=0;
    foreach($records as $mDeliveryNotificationMedicine){
?>
     <tr>
          <td>
               <?php echo ++$rowCount;?>
          </td>
          <td>
              <?php echo $mDeliveryNotificationMedicine->getId(); ?> 
          </td>
          <td>
              <?php echo $mDeliveryNotificationMedicine->getDeliveryNotification(); ?> 
          </td>
          <td>
              <?php echo $mDeliveryNotificationMedicine->getMedicine(); ?> 
          </td>
          <td>
              <?php echo $mDeliveryNotificationMedicine->getQuantity(); ?> 
          </td>
          <td>
              <?php echo $mDeliveryNotificationMedicine->getAmount(); ?> 
          </td>
      </tr>
<?php
    }
?>
    </tbody>

</table> <!-- end table -->
