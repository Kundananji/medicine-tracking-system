<?php
 require('../classes/database.php');
 require('../classes/patient.php');
  require("../classes/user.php");


$patient = new Patient();
// fetch all records from database
$records = $patient->getAllRecords();

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
                Name
            </th>
            <th>
                Date of Birth
            </th>
            <th>
                Gender
            </th>
            <th>
                User
            </th>
        </tr>
    </thead>
    <tbody>
<?php
    $rowCount=0;
    foreach($records as $mPatient){
?>
     <tr>
          <td>
               <?php echo ++$rowCount;?>
          </td>
          <td>
              <?php echo $mPatient->getId(); ?> 
          </td>
          <td>
              <?php echo $mPatient->getName(); ?> 
          </td>
          <td>
              <?php echo $mPatient->getDateOfBirth(); ?> 
          </td>
          <td>
              <?php echo $mPatient->getGender(); ?> 
          </td>
          <td>
              <?php echo $mPatient->getUser(); ?> 
          </td>
      </tr>
<?php
    }
?>
    </tbody>

</table> <!-- end table -->
