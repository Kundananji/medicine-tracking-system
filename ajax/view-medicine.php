<?php
session_start();
require('../classes/database.php');
require('../classes/medicine.php');
require("../classes/user.php");


$medicine = new Medicine();
// fetch all records from database
$records = $medicine->getAllRecords();

if (sizeof($records) == 0) {
    exit('<div class="alert alert-warning">No records available.</div>');
}
?>
<table class="table table-bordered table-striped" id="table-data-table">
    <thead>
        <tr>
            <th>
            </th>
            <th>
                ID
            </th>
            <th>
                Name
            </th>
            <th>
                Description
            </th>
            <th>
                Manufactured Date
            </th>
            <th>
                Expiry Date
            </th>
            <th>
                GTIN
            </th>
            <th>
                Serial Number
            </th>
            <th>
                LOT Number
            </th>
            <th>
                Package Details
            </th>
            <th>
                Manufacturer
            </th>
            <th>

            </th>
        </tr>
    </thead>
    <tbody>
        <?php
        $rowCount = 0;
        foreach ($records as $mMedicine) {
        ?>
            <tr>
                <td>
                    <?php echo ++$rowCount; ?>
                </td>
                <td>
                    <?php echo $mMedicine->getId(); ?>
                </td>
                <td>
                    <?php echo $mMedicine->getName(); ?>
                </td>
                <td>
                    <?php echo $mMedicine->getDescription(); ?>
                </td>
                <td>
                    <?php echo $mMedicine->getManufacturedDate(); ?>
                </td>
                <td>
                    <?php echo $mMedicine->getExpiryDate(); ?>
                </td>
                <td>
                    <?php echo $mMedicine->getGtin(); ?>
                </td>
                <td>
                    <?php echo $mMedicine->getSerialNumber(); ?>
                </td>
                <td>
                    <?php echo $mMedicine->getLotNumber(); ?>
                </td>
                <td>
                    <?php echo $mMedicine->getPackageDetails(); ?>
                </td>
                <td>
                    <?php echo $mMedicine->getManufacturer(); ?>
                </td>
                <td>
                    <?php
                      if($mMedicine->getManufacturerId()==$_SESSION['userId']){
                        echo'<a href="javascript:Medicine.addMedicine('.$mMedicine->getId().')"><i class=""bi bi-pencil-square"></i> Edit</a>';
                      }
                    ?>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>

</table> <!-- end table -->