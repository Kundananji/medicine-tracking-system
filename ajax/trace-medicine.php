<?php
session_start();
include('../includes/autoload.php');

$userId =$_SESSION['userId'];
$user = new User($userId);
$searchId =  null;
if($user->getUserType()->getName() != "Regulator" && $user->getUserType()->getName() != "Miner" ){
    $searchId = $userId;
}

$medicine = new Medicine();

$records = [];
if($searchId==null){
    $records = $medicine->getAllRecords();
}else{
    $records = $medicine->getAllRecordsByUserId($searchId);
}



if(sizeof($records) == 0){
  exit('<div class="alert alert-warning">No records available.</div>');
}
?>
<!--
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
    <button type="submit" class="btn btn-primary" onclick="Transaction.filterTransactions()">Filter</button>
  </div>
</form> -->
<table class="table table-striped table-bordered" id="table-data-table">
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

            <th>
                Serial Number
            </th>
            <th>
                Trace
            </th>
        </tr>
    </thead>
    <tbody>
<?php
    $rowCount=0;
    foreach($records as $mMedicine){
?>
     <tr>
          <td>
               <?php echo ++$rowCount;?>
          </td>
          <td>
              <?php echo $mMedicine->getId(); ?> 
          </td>
          <td>
              <?php echo $mMedicine->getName(); ?> 
          </td>

          <td>
              <?php echo $mMedicine->getDescription(); ?> 
          </td>
          
          <td>
              <?php echo $mMedicine->getSerialNumber(); ?> 
          </td>

          <td>
              <a href="javascript:Transaction.viewTrace({medicineId: '<?php echo $mMedicine->getId(); ?> '})"><i class="bi bi-geo-fill"></i> View Trace</a>
          </td>
 
      </tr>
<?php
    }
?>
    </tbody>

</table> <!-- end table -->
