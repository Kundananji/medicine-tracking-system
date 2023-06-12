<?php
 require('../classes/database.php');
 require('../classes/damagenotification.php');
  require("../classes/user.php");


$damageNotification = new DamageNotification();
// fetch all records from database
$records = $damageNotification->getAllRecords();

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
                Date of Notification
            </th>
            <th>
                Reported By
            </th>
            <th>
                Details
            </th>
            <th>
                Location
            </th>

            <th>

            </th>
        </tr>
    </thead>
    <tbody>
<?php
    $rowCount=0;
    foreach($records as $mDamageNotification){
?>
     <tr>
          <td>
               <?php echo ++$rowCount;?>
          </td>

          <td>
              <?php echo $mDamageNotification->getDateOfNotification(); ?> 
          </td>
          <td>
              <?php echo $mDamageNotification->getReporter(); ?> 
          </td>
          <td>
              <?php echo $mDamageNotification->getDetails(); ?> 
          </td>
   
          <td>
              <a href="javascript:showLocation('<?php echo $mDamageNotification->getLocation(); ?>')"><i class="bi bi-geo-alt-fill"></i> View Location</a>
          </td>
          <td>
              <a href="javascript:DamageNotificationMedicine.viewDamageNotificationMedicine({damageNotificationId: '<?php echo $mDamageNotification->getId(); ?> '})"><i class="bi bi-capsule-pill"></i> View Medicines</a>
          </td>
      </tr>
<?php
    }
?>
    </tbody>

</table> <!-- end table -->
