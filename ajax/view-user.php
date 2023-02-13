<?php
 require('../classes/database.php');
 require('../classes/user.php');
  require("../classes/usertype.php");


$user = new User();
// fetch all records from database
$records = $user->getAllRecords();

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
                Address
            </th>
            <th>
                Email
            </th>
            <th>
                Username
            </th>
            <th>
                Password
            </th>
            <th>
                User Type
            </th>
        </tr>
    </thead>
    <tbody>
<?php
    $rowCount=0;
    foreach($records as $mUser){
?>
     <tr>
          <td>
               <?php echo ++$rowCount;?>
          </td>
          <td>
              <?php echo $mUser->getId(); ?> 
          </td>
          <td>
              <?php echo $mUser->getName(); ?> 
          </td>
          <td>
              <?php echo $mUser->getAddress(); ?> 
          </td>
          <td>
              <?php echo $mUser->getEmail(); ?> 
          </td>
          <td>
              <?php echo $mUser->getUsername(); ?> 
          </td>
          <td>
              <?php echo $mUser->getPassword(); ?> 
          </td>
          <td>
              <?php echo $mUser->getUserType(); ?> 
          </td>
      </tr>
<?php
    }
?>
    </tbody>

</table> <!-- end table -->
