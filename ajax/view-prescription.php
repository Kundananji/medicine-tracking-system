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
<table class="table table-striped table-bordered" id="table-data-table">
    <thead>
        <tr>
            <th>
               &nbsp;
            </th>

            <th>
                Prescription Date
            </th>
            <th>
                Hospital
            </th>
            <th>
                Patient 
            </th>
            <th>
               Location
            </th>
            <th>
                 &nbsp;
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
              <?php echo $mPrescription->getPrescriptionDate(); ?> 
          </td>
          <td>
              <?php echo $mPrescription->getHospital(); ?> 
          </td>
          <td>
              <?php echo $mPrescription->getPatient(); ?> 
          </td>
          <td>
              <a href="javascript:showLocation('<?php echo $mPrescription->getLocation(); ?>')"><i class="bi bi-geo-alt-fill"></i> View Location</a>
          </td>
          <td>
              <a href="javascript:PrescriptionMedicine.viewPrescriptionMedicine({prescriptionId: '<?php echo $mPrescription->getId(); ?> '})"><i class="bi bi-capsule-pill"></i> View Medicines</a>
          </td>
      </tr>
<?php
    }
?>
    </tbody>

</table> <!-- end table -->
