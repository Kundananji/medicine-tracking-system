<?php
require('../classes/database.php');
require('../classes/deliverynotificationmedicine.php');
require("../classes/deliverynotification.php");
require("../classes/medicine.php");
require("../classes/user.php");

$deliveryNotificationId = isset($_GET['deliveryNotificationId']) ? trim(filter_var($_POST['deliveryNotificationId'], FILTER_SANITIZE_STRING)) : null;
$deliveryNotificationMedicine = new DeliveryNotificationMedicine();

if(!isset($deliveryNotificationId)){
// fetch all records from database
$records = $deliveryNotificationMedicine->getAllRecords();
}
else{
    $records = $deliveryNotificationMedicine->getRecordsByDeliveryNotificationId($deliveryNotificationId);
}
if (sizeof($records) == 0) {
    exit('<div class="alert alert-warning">No records available.</div>');
}
?>

<table class="table table-bordered" id="table-data-table">
    <thead>
        <tr>
            <th>
            </th>

            <th>
                Serial Number
            </th>
            <th>
                Medicine
            </th>
            <th>
                Batch No.
            </th>
            <th>
                GTIN No.
            </th>
            <th>
                Quantity
            </th>

        </tr>
    </thead>
    <tbody>
        <?php
        $rowCount = 0;
        foreach ($records as $mDeliveryNotificationMedicine) {
        ?>
            <tr>
                <td>
                    <?php echo ++$rowCount; ?>
                </td>

                <td>
                    <?php echo $mDeliveryNotificationMedicine->getMedicine()->getSerialNumber(); ?>
                </td>
                <td>
                    <?php echo $mDeliveryNotificationMedicine->getMedicine(); ?>
                </td>
                <td>
                    <?php echo $mDeliveryNotificationMedicine->getMedicine()->getLotNumber(); ?>
                </td>
                <td>
                    <?php echo $mDeliveryNotificationMedicine->getMedicine()->getGtin(); ?>
                </td>
                <td>
                    <?php echo $mDeliveryNotificationMedicine->getQuantity(); ?>
                </td>

            </tr>
        <?php
        }
        ?>
    </tbody>

</table> <!-- end table -->