<?php
include('../includes/autoload.php');

$transactionActor = new TransactionActor();

$transactionId = isset($_GET['transactionId']) ? trim($_GET['transactionId']) : null;
if (isset($transactionId)) {
    //select medicine under a particular sale notificaiton
    $records = $transactionActor->getRecordsByTransactionId($transactionId);
} else {
// fetch all records from database
$records = $transactionActor->getAllRecords();
}

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
