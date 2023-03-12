<?php
require('../classes/database.php');
require('../classes/receiptnotificationmedicine.php');
require("../classes/receiptnotification.php");
require("../classes/medicine.php");
require("../classes/user.php");

$receiptNotificationId = isset($_GET['receiptNotificationId']) ? $_GET['receiptNotificationId'] : null;

$receiptNotificationMedicine = new ReceiptNotificationMedicine();

if (isset($receiptNotificationId)) {
    //select medicine under a particular sale notificaiton
    $records = $receiptNotificationMedicine->getRecordsByReceiptNotificationId($receiptNotificationId);
} else {
    // fetch all records from database
    $records = $receiptNotificationMedicine->getAllRecords();
}


if (sizeof($records) == 0) {
    exit('<div class="alert alert-warning">No records available.</div>');
}
?>
<table class="table table-striped table-bordered" id="table-data-table">
    <thead>
        <tr>
            <th>
            </th>

            <th>
                Receipt Notification
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
        </tr>
    </thead>
    <tbody>
        <?php
        $rowCount = 0;
        foreach ($records as $mReceiptNotificationMedicine) {
        ?>
            <tr>
                <td>
                    <?php echo ++$rowCount; ?>
                </td>
                <td>
                    <?php echo $mReceiptNotificationMedicine->getReceiptNotification(); ?>
                </td>
                <td>
                    <?php echo $mReceiptNotificationMedicine->getMedicine(); ?>
                </td>
                <td>
                    <?php echo $mReceiptNotificationMedicine->getQuantity(); ?>
                </td>
                <td>
                    <?php echo $mReceiptNotificationMedicine->getAmount(); ?>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>

</table> <!-- end table -->