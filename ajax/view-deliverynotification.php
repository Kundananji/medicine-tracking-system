<?php
session_start();
require('../classes/database.php');
require('../classes/deliverynotification.php');
require("../classes/user.php");


$deliveryNotification = new DeliveryNotification();
// fetch all records from database
$records = $deliveryNotification->getAllRecords();

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
                ID
            </th>
            <th>
                Date of Delivery
            </th>
            <th>
                Delivered By
            </th>
            <th>
                Delivered To
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
        $rowCount = 0;
        foreach ($records as $mDeliveryNotification) {
        ?>
            <tr>
                <td>
                    <?php echo ++$rowCount; ?>
                </td>
                <td>
                    <?php echo $mDeliveryNotification->getId(); ?>
                </td>
                <td>
                    <?php echo $mDeliveryNotification->getDateOfDelivery(); ?>
                </td>
                <td>
                    <?php echo $mDeliveryNotification->getDeliverer(); ?>
                </td>
                <td>
                    <?php echo $mDeliveryNotification->getReceipient(); ?>
                </td>

                <td>
                    <a href="javascript:showLocation('<?php echo $mDeliveryNotification->getLocation(); ?>')"><i class="bi bi-geo-alt-fill"></i> View Location</a>
                </td>
                <td>
                    <a href="javascript:DeliveryNotificationMedicine.viewDeliveryNotificationMedicine({deliveryNotificationId: '<?php echo $mDeliveryNotification->getId(); ?> '})"><i class="bi bi-capsule-pill"></i> View Medicines</a>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>

</table> <!-- end table -->