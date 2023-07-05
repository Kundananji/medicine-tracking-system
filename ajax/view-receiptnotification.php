<?php
session_start();
$userId =$_SESSION['userId'];
include('../includes/autoload.php');
$user = new User($userId);

$receiptNotification = new ReceiptNotification();
// fetch all records from database
$records = $receiptNotification->getAllRecords($userId);

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
                Received By
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
