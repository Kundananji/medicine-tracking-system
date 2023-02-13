<?php
 require('../classes/database.php');
 require('../classes/transactionmedicine.php');
  require("../classes/transaction.php");
  require("../classes/medicine.php");


$transactionMedicine = new TransactionMedicine();
// fetch all records from database
$records = $transactionMedicine->getAllRecords();

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
                Transaction
            </th>
            <th>
                Medicine
            </th>
            <th>
                Details
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
    foreach($records as $mTransactionMedicine){
?>
     <tr>
          <td>
               <?php echo ++$rowCount;?>
          </td>
          <td>
              <?php echo $mTransactionMedicine->getId(); ?> 
          </td>
          <td>
              <?php echo $mTransactionMedicine->getTransaction(); ?> 
          </td>
          <td>
              <?php echo $mTransactionMedicine->getMedicine(); ?> 
          </td>
          <td>
              <?php echo $mTransactionMedicine->getDetails(); ?> 
          </td>
          <td>
              <?php echo $mTransactionMedicine->getQuantity(); ?> 
          </td>
          <td>
              <?php echo $mTransactionMedicine->getAmount(); ?> 
          </td>
      </tr>
<?php
    }
?>
    </tbody>

</table> <!-- end table -->
