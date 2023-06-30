<?php
session_start();
$userId =$_SESSION['userId'];
include('../includes/autoload.php');
$user = new User($userId);
$searchId = null;
if($user->getUserType()->getName() != "Regulator" && $user->getUserType()->getName() != "Miner" ){
    $searchId = $userId;
}

$transactionId = isset($_GET['transactionId']) ? trim($_GET['transactionId']) : null;

$transaction = new Transaction($transactionId);

$records = [];

if($transactionId!=null){
    $records  = [$transaction];
}
else{
    if(isset($_GET['searchTerm']) || isset($_GET['startDate']) || isset($_GET['endDate'])){
        $searchTerm = isset($_GET['searchTerm'])?$_GET['searchTerm']:null;
        $startDate = isset($_GET['startDate'])?$_GET['startDate']:null;
        $endDate = isset($_GET['endDate'])?$_GET['endDate']:null;
        $records = $transaction->search($startDate,$endDate,$searchTerm,$searchId);
      }
      else{
      // fetch all records from database
      $records = $transaction->getAllRecords($searchId);
      }
}


if(sizeof($records) == 0){
  exit('<div class="alert alert-warning">No records available.</div>');
}
?>
<form class="row gx-3 gy-2 align-items-center m-3">
  <div class="col-sm-3">
    <label class="visually-hidden" for="startDate">Start Date</label>
    <input type="date" class="form-control" id="startDate" placeholder="Enter Start Date" <?php echo !isset($startDate)?(""):('value="'.$startDate.'"');?>>
  </div>
  <div class="col-sm-3">
    <label class="visually-hidden" for="endDate">End Date</label>
      <input type="date" class="form-control" id="endDate" placeholder="Enter End Date" <?php echo !isset($endDate)?(""):('value="'.$endDate.'"');?>>    
  </div>
  <div class="col-sm-3">
  <label class="visually-hidden" for="searchTerm">Search Term</label>
      <input type="text" class="form-control" id="searchTerm" placeholder="Enter Search Term" <?php echo !isset($searchTerm)?(""):('value="'.$searchTerm.'"');?>>  
  </div>

  <div class="col-auto">
    <button type="submit" class="btn btn-primary" onclick="Transaction.filterTransactions()">Filter</button>
  </div>
</form>
<table class="table table-striped table-bordered" id="table-data-table">
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
                Transaction Type
            </th>
            <th>
                Location
            </th>
            <th>
                Medicine
            </th>
            <th>
                Actors
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
              <?php echo date("jS F, Y",strtotime($mTransaction->getDateOfTransaction())); ?> 
          </td>
          <td>
              <?php echo $mTransaction->getDetails(); ?> 
          </td>

          <td>
              <?php echo $mTransaction->getTransactionType(); ?> 
          </td>
          <td>
              <a href="javascript:showLocation('<?php echo $mTransaction->getLocation(); ?>')"><i class="bi bi-geo-alt-fill"></i> View Location</a>
          </td>
          <td>
              <a href="javascript:TransactionMedicine.viewTransactionMedicine({transactionId: '<?php echo $mTransaction->getId(); ?> '})"><i class="bi bi-capsule-pill"></i> View Medicines</a>
          </td>
          <td>
              <a href="javascript:TransactionActor.viewTransactionActor({transactionId: '<?php echo $mTransaction->getId(); ?>'})"><i class="bi bi-people"></i> View Actors</a>
          </td>
      </tr>
<?php
    }
?>
    </tbody>

</table> <!-- end table -->
