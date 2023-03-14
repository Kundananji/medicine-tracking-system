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
<table class="table table-bordered">
    <thead>
        <tr>
            <th>
            </th>
            <th>
                ID
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
              <?php echo $mDamageNotification->getId(); ?> 
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
              <?php echo $mDamageNotification->getLocation(); ?> 
          </td>
      </tr>
<?php
    }
?>
    </tbody>

</table> <!-- end table -->
