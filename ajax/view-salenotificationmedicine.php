<?php
require('../classes/database.php');
require('../classes/salenotificationmedicine.php');
require("../classes/salenotification.php");
require("../classes/medicine.php");
require("../classes/user.php");


$saleNotificationId = isset($_GET['saleNotificationId']) ? $_GET['saleNotificationId'] : null;

$saleNotificationMedicine = new SaleNotificationMedicine();


if (isset($saleNotificationId)) {
    //select medicine under a particular sale notificaiton
    $records = $saleNotificationMedicine->getRecordsBySaleNotificationId($saleNotificationId);
} else {

    // fetch all records from database
    $records = $saleNotificationMedicine->getAllRecords();
}

if (sizeof($records) == 0) {
    exit('<div class="alert alert-warning">No records available.</div>');
}
?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>
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
        foreach ($records as $mSaleNotificationMedicine) {
        ?>
            <tr>
                <td>
                    <?php echo ++$rowCount; ?>
                </td>
                
                <td>
                    <?php echo $mSaleNotificationMedicine->getMedicine(); ?>
                </td>
                <td>
                    <?php echo $mSaleNotificationMedicine->getQuantity(); ?>
                </td>
                <td>
                    <?php echo $mSaleNotificationMedicine->getAmount(); ?>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>

</table> <!-- end table -->