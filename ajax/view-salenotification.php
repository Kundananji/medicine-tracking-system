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
<table class="table table-bordered">
    <thead>
        <tr>
            <th>
            </th>
            <th>
                ID
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
              <?php echo $mSaleNotification->getId(); ?> 
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
              <?php echo $mSaleNotification->getLocation(); ?> 
          </td>
      </tr>
<?php
    }
?>
    </tbody>

</table> <!-- end table -->
