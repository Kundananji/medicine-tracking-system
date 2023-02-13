<?php
  require("../classes/database.php");
  require("../classes/receiptnotification.php");
  require("../classes/user.php");
?>
<div class="card">
    <div class="card-header">
        <h3>Add ReceiptNotification</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <form method="post" id="form-add-receiptnotification" onsubmit="ReceiptNotification.submitForm(event);">
                     <input type="hidden" name="id" id="id" value="0"/>
                    <div class="form-group m-3">
                        <label for="dateOfReceipt">Date of Receipt</label>
                        <input type="date"  id="dateOfReceipt" class="form-control" name="dateOfReceipt" placeholder="Enter Date of Receipt"  required/>
                    </div>
                    <div class="form-group m-3">
                        <label for="buyerId">Buyer</label>
                         <select class="form-control" name="buyerId" id="buyerId">
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
                        <label for="sellerId">Seller</label>
                         <select class="form-control" name="sellerId" id="sellerId">
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
