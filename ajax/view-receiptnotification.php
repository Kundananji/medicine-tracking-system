<?php
 require('../classes/database.php');
 require('../classes/receiptnotification.php');
  require("../classes/user.php");


$receiptNotification = new ReceiptNotification();
// fetch all records from database
$records = $receiptNotification->getAllRecords();

if(sizeof($records) == 0){
  exit('<div class="alert alert-warning">No records available.</div>');
}
?>
<table class="table table-striped table-bordered" id="table-data-table">
    <thead>
        <tr>
            <th>
            </th>
            <th>
                Date of Receipt
            </th>
            <th>
                Buyer
            </th>
            <th>
                Seller
            </th>
            <th>
                Location
            </th>
            <th>
                Medicine
            </th>
        </tr>
    </thead>
    <tbody>
<?php
    $rowCount=0;
    foreach($records as $mReceiptNotification){
?>
     <tr>
          <td>
               <?php echo ++$rowCount;?>
          </td>

          <td>
              <?php echo $mReceiptNotification->getDateOfReceipt(); ?> 
          </td>
          <td>
              <?php echo $mReceiptNotification->getBuyer(); ?> 
          </td>
          <td>
              <?php echo $mReceiptNotification->getSeller(); ?> 
          </td>
          <td>
              <a href="javascript:showLocation('<?php echo $mReceiptNotification->getLocation(); ?>')"><i class="bi bi-geo-alt-fill"></i> View Location</a>
          </td>
          <td>
              <a href="javascript:ReceiptNotificationMedicine.viewReceiptNotificationMedicine({receiptNotificationId: '<?php echo $mReceiptNotification->getId(); ?> '})"><i class="bi bi-capsule-pill"></i> View Medicines</a>
          </td>
      </tr>
<?php
    }
?>
    </tbody>

</table> <!-- end table -->
