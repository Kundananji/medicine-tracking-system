<?php
session_start();
require('../classes/database.php');
require("../classes/user.php");
require('../classes/damagenotificationmedicine.php');
require("../classes/damagenotification.php");
require("../classes/medicine.php");

$damageNotificationId = isset($_GET['damageNotificationId']) ? trim(filter_var($_GET['damageNotificationId'], FILTER_SANITIZE_STRING)) : null;

$damageNotificationMedicine = new DamageNotificationMedicine();
if (isset($damageNotificationId)) {

    $records = $damageNotificationMedicine->getRecordsByDamageNotificationId($damageNotificationId);
} else {
    // fetch all records from database
    $records = $damageNotificationMedicine->getAllRecords();
}
if (sizeof($records) == 0) {
    exit('<div class="alert alert-warning">No records available.</div>');
}
?>
<table class="table table-striped table-bordered" id="table-data-table">
    <thead>
        <tr>
            <th>
                &nbsp;
            </th>

            <th>
                Medicine
            </th>
            <th>
                Quantity
            </th>
            <th>
                Details of Damage
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
        $rowCount = 0;
        foreach ($records as $mDamageNotificationMedicine) {
        ?>
            <tr>
                <td>
                    <?php echo ++$rowCount; ?>
                </td>


                <td>
                    <?php echo $mDamageNotificationMedicine->getMedicine(); ?>
                </td>
                <td>
                    <?php echo $mDamageNotificationMedicine->getQuantity(); ?>
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