<?php
 require('../classes/database.php');
 require('../classes/usertype.php');


$userType = new UserType();
// fetch all records from database
$records = $userType->getAllRecords();

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
                Description
            </th>
            <th>
                Can Add Medicine
            </th>
            <th>
                Can View Medicine
            </th>
            <th>
                Can Sale
            </th>
            <th>
                Can Buy
            </th>
            <th>
                Can Receive
            </th>
            <th>
                Can Deliver
            </th>
            <th>
                Can Dispense
            </th>
        </tr>
    </thead>
    <tbody>
<?php
    $rowCount=0;
    foreach($records as $mUserType){
?>
     <tr>
          <td>
               <?php echo ++$rowCount;?>
          </td>
          <td>
              <?php echo $mUserType->getId(); ?> 
          </td>
          <td>
              <?php echo $mUserType->getName (); ?> 
          </td>
          <td>
              <?php echo $mUserType->getDescription(); ?> 
          </td>
          <td>
              <?php echo $mUserType->getCanAddMedicine(); ?> 
          </td>
          <td>
              <?php echo $mUserType->getCanViewMedicine(); ?> 
          </td>
          <td>
              <?php echo $mUserType->getCanSale(); ?> 
          </td>
          <td>
              <?php echo $mUserType->getCanBuy(); ?> 
          </td>
          <td>
              <?php echo $mUserType->getCanReceive(); ?> 
          </td>
          <td>
              <?php echo $mUserType->getCanDeliver(); ?> 
          </td>
          <td>
              <?php echo $mUserType->getCanDispense(); ?> 
          </td>
      </tr>
<?php
    }
?>
    </tbody>

</table> <!-- end table -->
