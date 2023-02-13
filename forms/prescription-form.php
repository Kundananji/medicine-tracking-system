<?php
  require("../classes/database.php");
  require("../classes/prescription.php");
  require("../classes/user.php");
?>
<div class="card">
    <div class="card-header">
        <h3>Add Prescription</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <form method="post" id="form-add-prescription" onsubmit="Prescription.submitForm(event);">
                     <input type="hidden" name="id" id="id" value="0"/>
                    <div class="form-group m-3">
                        <label for="prescriptionDate">Prescription Date</label>
                        <input type="date"  id="prescriptionDate" class="form-control" name="prescriptionDate" placeholder="Enter Prescription Date"  required/>
                    </div>
                    <div class="form-group m-3">
                        <label for="hospitalId">Hospital</label>
                         <select class="form-control" name="hospitalId" id="hospitalId">
                        <?php
                            $user = new User;
                            $records =$user->getAllRecords();
                            foreach($records as $mUser){
                                 echo'<option value="'.$mUser->getId().'">'.$mUser->getName().'</option>';
                               }
                         ?>
                         </select>
                    </div>
                    <div class="form-group m-3">
                        <label for="patientId">Patient Id</label>
                         <select class="form-control" name="patientId" id="patientId">
                        <?php
                            $user = new User;
                            $records =$user->getAllRecords();
                            foreach($records as $mUser){
                                 echo'<option value="'.$mUser->getId().'">'.$mUser->getName().'</option>';
                               }
                         ?>
                         </select>
                    </div>
                      <input type="submit" class="btn btn-primary" name="action_submit" value="Submit"/>
                  </form> <!-- end form-->
           </div> <!-- end column-->
        </div> <!-- end row-->
      </div><!-- end card body-->
    </div> <!-- end card--->
