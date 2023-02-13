<?php
 require('../classes/database.php');
 require('../classes/transaction.php');
  require("../classes/transactiontype.php");


$transaction = new Transaction();
// fetch all records from database
$records = $transaction->getAllRecords();

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
                Date of Transaction
            </th>
            <th>
                Details
            </th>
            <th>
                Location
            </th>
            <th>
                Transaction Type
            </th>
        </tr>
    </thead>
    <tbody>
<?php
    $rowCount=0;
    foreach($records as $mTransaction){
?>
     <tr>
          <td>
               <?php echo ++$rowCount;?>
          </td>
          <td>
              <?php echo $mTransaction->getId(); ?> 
          </td>
          <td>
              <?php echo $mTransaction->getDateOfTransaction(); ?> 
          </td>
          <td>
              <?php echo $mTransaction->getDetails(); ?> 
          </td>
          <td>
              <?php echo $mTransaction->getLocation(); ?> 
          </td>
          <td>
              <?php echo $mTransaction->getTransactionType(); ?> 
          </td>
      </tr>
<?php
    }
?>
    </tbody>

</table> <!-- end table -->
