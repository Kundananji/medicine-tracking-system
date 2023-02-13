<?php
 require('../classes/database.php');
 require('../classes/salenotificationmedicine.php');
  require("../classes/salenotification.php");
  require("../classes/medicine.php");


$saleNotificationMedicine = new SaleNotificationMedicine();
// fetch all records from database
$records = $saleNotificationMedicine->getAllRecords();

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
                Sale Notification
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
    foreach($records as $mSaleNotificationMedicine){
?>
     <tr>
          <td>
               <?php echo ++$rowCount;?>
          </td>
          <td>
              <?php echo $mSaleNotificationMedicine->getId(); ?> 
          </td>
          <td>
              <?php echo $mSaleNotificationMedicine->getSaleNotification(); ?> 
          </td>
          <td>
              <?php echo $mSaleNotificationMedicine->getMedicine(); ?> 
          </td>
          <td>
              <?php echo $mSaleNotificationMedicine->getQuantity(); ?> 
          </td>
          <td>
              <?php echo $mSaleNotificationMedicine->getAmount(); ?> 
          </td>
      </tr>
<?php
    }
?>
    </tbody>

</table> <!-- end table -->
