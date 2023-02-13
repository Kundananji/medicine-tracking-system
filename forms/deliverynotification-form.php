<?php
  require("../classes/database.php");
  require("../classes/deliverynotification.php");
  require("../classes/user.php");
?>
<div class="card">
    <div class="card-header">
        <h3>Add DeliveryNotification</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <form method="post" id="form-add-deliverynotification" onsubmit="DeliveryNotification.submitForm(event);">
                     <input type="hidden" name="id" id="id" value="0"/>
                    <div class="form-group m-3">
                        <label for="dateOfDelivery">Date of Delivery</label>
                        <input type="date"  id="dateOfDelivery" class="form-control" name="dateOfDelivery" placeholder="Enter Date of Delivery"  required/>
                    </div>
                    <div class="form-group m-3">
                        <label for="deliveredById">Delivered By</label>
                         <select class="form-control" name="deliveredById" id="deliveredById">
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
                        <label for="deliveredToId">Delivered To</label>
                         <select class="form-control" name="deliveredToId" id="deliveredToId">
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
                        <label for="location">Location</label>
                        <input type="text"  id="location" class="form-control" name="location" placeholder="Enter Location"  required/>
                    </div>
                      <input type="submit" class="btn btn-primary" name="action_submit" value="Submit"/>
                  </form> <!-- end form-->
           </div> <!-- end column-->
        </div> <!-- end row-->
      </div><!-- end card body-->
    </div> <!-- end card--->
