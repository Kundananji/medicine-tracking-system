<?php
  require("../classes/database.php");
  require("../classes/damagenotification.php");
  require("../classes/user.php");
?>
<div class="card">
    <div class="card-header">
        <h3>Add DamageNotification</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <form method="post" id="form-add-damagenotification" onsubmit="DamageNotification.submitForm(event);">
                     <input type="hidden" name="id" id="id" value="0"/>
                    <div class="form-group m-3">
                        <label for="dateOfNotification">Date of Notification</label>
                        <input type="date"  id="dateOfNotification" class="form-control" name="dateOfNotification" placeholder="Enter Date of Notification"  required/>
                    </div>
                    <div class="form-group m-3">
                        <label for="reportedbyId">Reported By</label>
                         <select class="form-control" name="reportedbyId" id="reportedbyId">
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
                        <label for="details">Details</label>
                        <textarea  id="details" class="form-control" name="details" placeholder="Enter Details"  required></textarea>
                    </div>
                    <div class="form-group m-3">
                        <label for="location">Location</label>
                        <input type="text"  id="location" class="form-control" name="location" placeholder="Enter Location"  required/>
                    </div>
                      <input type="submit" class="btn btn-primary" name="action_submit" value="Submit"/>
                  </form> <!-- end form-->
           </div> <!-- end column-->
        </div> <!-- end row-->
      </div><!-- end card body-->
    </div> <!-- end card--->