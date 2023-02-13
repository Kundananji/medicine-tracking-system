<?php
 require('../classes/database.php');
 require('../classes/transactionactor.php');
  require("../classes/user.php");
  require("../classes/transactionrole.php");


$transactionActor = new TransactionActor();
// fetch all records from database
$records = $transactionActor->getAllRecords();

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
                User
            </th>
            <th>
                Transaction Role
            </th>
        </tr>
    </thead>
    <tbody>
<?php
    $rowCount=0;
    foreach($records as $mTransactionActor){
?>
     <tr>
          <td>
               <?php echo ++$rowCount;?>
          </td>
          <td>
              <?php echo $mTransactionActor->getId(); ?> 
          </td>
          <td>
              <?php echo $mTransactionActor->getActor(); ?> 
          </td>
          <td>
              <?php echo $mTransactionActor->getRole(); ?> 
          </td>
      </tr>
<?php
    }
?>
    </tbody>

</table> <!-- end table -->
