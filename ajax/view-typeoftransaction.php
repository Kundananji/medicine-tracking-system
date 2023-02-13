<?php
 require('../classes/database.php');
 require('../classes/typeoftransaction.php');


$typeOfTransaction = new TypeOfTransaction();
// fetch all records from database
$records = $typeOfTransaction->getAllRecords();

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
        </tr>
    </thead>
    <tbody>
<?php
    $rowCount=0;
    foreach($records as $mTypeOfTransaction){
?>
     <tr>
          <td>
               <?php echo ++$rowCount;?>
          </td>
          <td>
              <?php echo $mTypeOfTransaction->getId(); ?> 
          </td>
          <td>
              <?php echo $mTypeOfTransaction->getName (); ?> 
          </td>
          <td>
              <?php echo $mTypeOfTransaction->getDescription(); ?> 
          </td>
      </tr>
<?php
    }
?>
    </tbody>

</table> <!-- end table -->
