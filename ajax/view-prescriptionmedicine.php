<?php
 require('../classes/database.php');
 require('../classes/prescriptionmedicine.php');
  require("../classes/prescription.php");
  require("../classes/medicine.php");


$prescriptionMedicine = new PrescriptionMedicine();
// fetch all records from database
$records = $prescriptionMedicine->getAllRecords();

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
                Prescription
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
            <th>
                Dosage
            </th>
        </tr>
    </thead>
    <tbody>
<?php
    $rowCount=0;
    foreach($records as $mPrescriptionMedicine){
?>
     <tr>
          <td>
               <?php echo ++$rowCount;?>
          </td>
          <td>
              <?php echo $mPrescriptionMedicine->getId(); ?> 
          </td>
          <td>
              <?php echo $mPrescriptionMedicine->getPrescription(); ?> 
          </td>
          <td>
              <?php echo $mPrescriptionMedicine->getMedicine(); ?> 
          </td>
          <td>
              <?php echo $mPrescriptionMedicine->getQuantity(); ?> 
          </td>
          <td>
              <?php echo $mPrescriptionMedicine->getAmount(); ?> 
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
