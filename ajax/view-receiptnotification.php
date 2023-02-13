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
<table class="table table-bordered">
    <thead>
        <tr>
            <th>
            </th>
            <th>
                ID
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
              <?php echo $mReceiptNotification->getId(); ?> 
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
              <?php echo $mReceiptNotification->getLocation(); ?> 
          </td>
      </tr>
<?php
    }
?>
    </tbody>

</table> <!-- end table -->
