<?php
include('../includes/autoload.php');

$transaction = new Transaction();
$medicineId = isset($_GET['medicineId'])?$_GET['medicineId']:null;
$records = [];
$records = $transaction->searchByMedicineId($medicineId);



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
                Date 
            </th>
            <th>
                Action Performed
            </th>
            <th>
                Transaction ID
            </th>


            <th>
                Details
            </th>


            <th>
                Location
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
              <?php echo date("jS F, Y",strtotime($mTransaction->getDateOfTransaction())); ?> 
          </td>

          <td style="font-weight:bold">
              <?php 
               switch($mTransaction->getTransactionType()){
                case 'Sale': echo 'Sold';
                break;
                case 'Manufacture': echo 'Manufactured';
                break;
                case 'Receipt': echo 'Received';
                break;
                case 'Delivery': echo 'Delivered';
                break;
                case 'Prescription': echo 'Prescribed';
                break;
                
                default:
                echo 'Transaction';

               }
              
              ?> 
          </td>
          <td>
          <a href="javascript:Transaction.viewTransaction({transactionId:'<?php echo $mTransaction->getId(); ?>'})"> <?php echo $mTransaction->getId(); ?> </a>
          </td>

          <td>
              <?php echo $mTransaction->getDetails(); ?> 
          </td>


          <td>
              <a href="javascript:showLocation('<?php echo $mTransaction->getLocation(); ?>')"><i class="bi bi-geo-alt-fill"></i> View Location</a>
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
