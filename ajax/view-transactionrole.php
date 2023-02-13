<?php
 require('../classes/database.php');
 require('../classes/transactionrole.php');


$transactionRole = new TransactionRole();
// fetch all records from database
$records = $transactionRole->getAllRecords();

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
                Name
            </th>
            <th>
                Description
            </th>
        </tr>
    </thead>
    <tbody>
<?php
    $rowCount=0;
    foreach($records as $mTransactionRole){
?>
     <tr>
          <td>
               <?php echo ++$rowCount;?>
          </td>
          <td>
              <?php echo $mTransactionRole->getId(); ?> 
          </td>
          <td>
              <?php echo $mTransactionRole->getName (); ?> 
          </td>
          <td>
              <?php echo $mTransactionRole->getDescription(); ?> 
          </td>
      </tr>
<?php
    }
?>
    </tbody>

</table> <!-- end table -->
