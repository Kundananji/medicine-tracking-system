<?php

include('classes/database.php');
include('classes/medicine.php');

$manufacturerId = isset($_POST['manufacturerId']) ? trim($_POST['manufacturerId']) : null;
$medicine = new Medicine();
try {

    $medicine->setManufacturerId($manufacturerId);
    $medicines = [];

    if (isset($manufacturerId)) {
        $medicines = $medicine->getMedicineByManufacturer();
    } else {
        $medicines = $medicine->getMedicines();
    }

    if (sizeof($medicines) == 0) {
        echo '<div class="alert alert-warning">No medicines have been defined</div>';
    }

?>
    <table>
        <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Description</th>
                <th>Manufactured Date</th>
                <th>Expiry Date</th>
                <th>GTIN</th>
                <th>Serial Number</th>
                <th>LOT Number</th>
                <th>Package Details</th>
                <th></th>
            </tr>

        </thead>
        <tbody>
            <?php
            $count = 0;
            foreach ($medicines as $mMedicine) {
            ?>
                <tr>
                    <td><?php echo ++$count; ?></td>
                    <td><?php echo $mMedicine->getName(); ?></td>
                    <td><?php echo $mMedicine->getDescription(); ?></td>
                    <td><?php echo $mMedicine->getManufacturedDate(); ?></td>
                    <td><?php echo $mMedicine->getExpiryDate(); ?></td>
                    <td><?php echo $mMedicine->getGtin(); ?></td>
                    <td><?php echo $mMedicine->getSerialNumber(); ?></td>
                    <td><?php echo $mMedicine->getLotNumber(); ?></td>
                    <td><?php echo $mMedicine->getPackageDetails(); ?></td>
                    <td><a href="#" onclick="Medicines.EditMedicine(<?php $mMedicine->getId(); ?>)" class="btn btn-success">Edit</a></td>
                </tr>
            <?php
            }
            ?>

        </tbody>
    </table>

<?php



} catch (Exception $ex) {
    echo '<div class="alert alert-warning">An error occurred. Try again later</div>';
}
