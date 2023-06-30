<?php
session_start();
$userId =$_SESSION['userId'];
include('../includes/autoload.php');
$user = new User($userId);
$searchId = null;
if($user->getUserType()->getName() != "Regulator" && $user->getUserType()->getName() != "Miner" ){
    $searchId = $userId;
}

$transaction = new Transaction();
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

if(sizeof($records) == 0){
  echo('<div class="alert alert-warning">No records available.</div>');
}
?>
<div class="alert alert-info">This map shows all the locations of various transactions performed on the system according to provided search paramaters.</div>
<form class="row gx-3 gy-2 align-items-center m-2">
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
    <button type="submit" class="btn btn-primary" onclick="filterTransactions()">Filter</button>
  </div>
</form>

<div id="map-trace" style="width:100%;height:500px;background:#f0f0f0">

</div>
<script>
$(document).ready(()=>{
    loadTracer();
});


var locations = [];
<?php 
 foreach($records as $mTransaction){
    echo 'locations.push({label: \''.$mTransaction->getDetails().'\',location:\''.$mTransaction->getLocation().'\',transactionId:\''.$mTransaction->getId().'\'});'."\n";
 }
?>
</script>
