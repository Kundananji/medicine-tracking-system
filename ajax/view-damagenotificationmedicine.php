<?php
 require('../classes/database.php');
 require('../classes/damagenotificationmedicine.php');
  require("../classes/damagenotification.php");
  require("../classes/medicine.php");


$damageNotificationMedicine = new DamageNotificationMedicine();
// fetch all records from database
$records = $damageNotificationMedicine->getAllRecords();

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
                Damage Notification
            </th>
            <th>
                Medicine
            </th>
            <th>
                Quantity
            </th>
            <th>
                Amount
            </th>
            <th>
                Details of Damage
            </th>
        </tr>
    </thead>
    <tbody>
<?php
    $rowCount=0;
    foreach($records as $mDamageNotificationMedicine){
?>
     <tr>
          <td>
               <?php echo ++$rowCount;?>
          </td>
          <td>
              <?php echo $mDamageNotificationMedicine->getId(); ?> 
          </td>
          <td>
              <?php echo $mDamageNotificationMedicine->getDamageNotification(); ?> 
          </td>
          <td>
              <?php echo $mDamageNotificationMedicine->getMedicine(); ?> 
          </td>
          <td>
              <?php echo $mDamageNotificationMedicine->getQuantity(); ?> 
          </td>
          <td>
              <?php echo $mDamageNotificationMedicine->getAmount(); ?> 
          </td>
          <td>
              <?php echo $mDamageNotificationMedicine->getDetails(); ?> 
          </td>
      </tr>
<?php
    }
?>
    </tbody>

</table> <!-- end table -->
