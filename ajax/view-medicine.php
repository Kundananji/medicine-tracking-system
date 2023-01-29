<?php

include('classes/database.php');
include('classes/medicine.php');

$manufacturerId=isset($_POST['manufacturerId'])?trim($_POST['manufacturerId']):null;

$medicine = new Medicine();
try{

$medicine->setManufacturerId($manufacturerId);
$medicines = [];



if(isset($manufacturerId)){
    $medicines = $medicine->getMedicineByManufacturer();
}
else{
    $medicines = $medicine->getMedicines();
}

if(sizeof($medicines) ==0){
    echo'<div class="alert alert-warning">No medicines have been defined</div>';
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
         foreach($medicines as $mMedicine){
        ?>
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
        <?php 
         }
        ?>

    </tbody>
  </table>

<?php



}
catch(Exception $ex){
    echo'<div class="alert alert-warning">An error occurred. Try again later</div>';
}


