<?php
 require('../classes/database.php');
 require('../classes/salenotification.php');
  require("../classes/user.php");


$saleNotification = new SaleNotification();
// fetch all records from database
$records = $saleNotification->getAllRecords();

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
                Date of Sale
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
    foreach($records as $mSaleNotification){
?>
     <tr>
          <td>
               <?php echo ++$rowCount;?>
          </td>
          <td>
              <?php echo $mSaleNotification->getDateOfSale(); ?> 
          </td>
          <td>
              <?php echo $mSaleNotification->getBuyer(); ?> 
          </td>
          <td>
              <?php echo $mSaleNotification->getSeller(); ?> 
          </td>
          <td>
              <a href="javascript:showLocation('<?php echo $mSaleNotification->getLocation(); ?>')"><i class="bi bi-geo-alt-fill"></i> View Location</a>
          </td>
          <td>
              <a href="javascript:SaleNotificationMedicine.viewSaleNotificationMedicine({saleNotificationId: '<?php echo $mSaleNotification->getId(); ?> '})"><i class="bi bi-capsule-pill"></i> View Medicines</a>
          </td>
      </tr>
<?php
    }
?>
    </tbody>

</table> <!-- end table -->
