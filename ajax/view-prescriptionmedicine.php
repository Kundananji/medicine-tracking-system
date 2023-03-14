<?php
session_start();
require('../classes/database.php');
require('../classes/prescriptionmedicine.php');
require("../classes/prescription.php");
require("../classes/medicine.php");
require("../classes/user.php");

$prescriptionMedicine = new PrescriptionMedicine();

$prescriptionId = isset($_GET['prescriptionId']) ? $_GET['prescriptionId'] : null;

if (isset($prescriptionId)) {
    //select medicine under a particular prescription notificaiton
    $records = $prescriptionMedicine->getRecordsByPrescriptionId($prescriptionId);
}
else{
// fetch all records from database
$records = $prescriptionMedicine->getAllRecords();
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
                Dosage
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
        $rowCount = 0;
        foreach ($records as $mPrescriptionMedicine) {
        ?>
            <tr>
                <td>
                    <?php echo ++$rowCount; ?>
                </td>

                <td>
                    <?php echo $mPrescriptionMedicine->getMedicine(); ?>
                </td>

                <td>
                    <?php echo $mPrescriptionMedicine->getQuantity(); ?>
                </td>

                <td>
                    <?php echo $mPrescriptionMedicine->getDosage(); ?>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>

</table> <!-- end table -->