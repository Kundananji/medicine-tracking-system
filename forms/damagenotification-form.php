<?php
  session_start();
  require("../classes/database.php");
  require("../classes/damagenotification.php");
  require("../classes/user.php");
?>
<div class="card">
    <div class="card-header">
        <h3>Add Damage Notification</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <form method="post" id="form-add-notification" onsubmit="DamageNotification.submitForm(event);">
                     <input type="hidden" name="id" id="id" value="0"/>
                    <div class="form-group m-3">
                        <label for="dateOfNotification">Date of Notification</label>
                        <input type="date"  id="dateOfNotification" class="form-control" name="dateOfNotification" placeholder="Enter Date of Notification"  required/>
                    </div>
                    <!-- If you are reporting datam, you are the reporter-->
                    <!-- hence reportedbyId is hidden-->

                    <input type="hidden" name="reportedbyId" id="reportedbyId" value="<?php echo $_SESSION['userId']; ?>">
                    <!--
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
                            -->
                    <div class="form-group m-3">
                        <label for="details">Details</label>
                        <textarea  id="details" class="form-control" name="details" placeholder="Enter Details"  required></textarea>
                    </div>
                    <div class="form-group m-3">
                        <label for="location">Location</label>
                        <input type="text"  id="location" onfocus="pickLocation(this)" class="form-control" name="location" placeholder="Enter Location"  required/>
                    </div>
                    <hr>
                    <h5>Add Medicines</h5>

                    <div class="alert alert-info">
                        <p>Specify the Medicines that were damaged</p>
                        <p>Search by name to add medicine, or by lot number (batch number) to add all the medicines in a particular batch</p>
                    </div>

                    <div id="added-medicines">

                    </div>
                    <div class="input-group mb-3">
                    <input type="text" id="text-search-medicine" class="form-control" placeholder="Enter medicine name or Batch No." aria-label="Enter medicine name or Batch No." aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="button-search-medicine" onclick="Medicine.searchMedicine()"><i class="bi bi-search"></i> Search</button>
                    </div>
                    </div>
                    <div class="m-3" id="medicines-found">

                    </div>
                    <hr>
                    <div id="submit-feedback">
					 
					 </div>
                    <hr>
                      <input type="submit" class="btn btn-primary" name="action_submit" value="Submit"/>
                  </form> <!-- end form-->
           </div> <!-- end column-->
        </div> <!-- end row-->
      </div><!-- end card body-->
    </div> <!-- end card--->
