<?php
 require('../classes/database.php');
 require('../classes/prescription.php');
  require("../classes/user.php");


$prescription = new Prescription();
// fetch all records from database
$records = $prescription->getAllRecords();

if(sizeof($records) == 0){
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
                Prescription Date
            </th>
            <th>
                Hospital
            </th>
            <th>
                Patient Id
            </th>
        </tr>
    </thead>
    <tbody>
<?php
    $rowCount=0;
    foreach($records as $mPrescription){
?>
     <tr>
          <td>
               <?php echo ++$rowCount;?>
          </td>
          <td>
              <?php echo $mPrescription->getId(); ?> 
          </td>
          <td>
              <?php echo $mPrescription->getPrescriptionDate(); ?> 
          </td>
          <td>
              <?php echo $mPrescription->getHospital(); ?> 
          </td>
          <td>
              <?php echo $mPrescription->getPatient(); ?> 
          </td>
      </tr>
<?php
    }
?>
    </tbody>

</table> <!-- end table -->
