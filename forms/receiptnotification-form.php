<?php
  require("../classes/database.php");
  require("../classes/receiptnotification.php");
  require("../classes/user.php");
?>
<div class="card">
    <div class="card-header">
        <h3>Add Receipt Notification</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <form method="post" id="form-add-notification" onsubmit="ReceiptNotification.submitForm(event);">
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
                        <input type="text"  id="location" onfocus="pickLocation(this)" class="form-control" name="location" placeholder="Enter Location"  required/>
                    </div>

                    <hr>
                    <h5>Add Medicines</h5>

                    <div class="alert alert-info">
                        <p>Specify the Medicines that were received</p>
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
                    <div id="submit_notice_feedback">

                    </div>
                      <input type="submit" class="btn btn-primary" name="action_submit" value="Submit"/>
                  </form> <!-- end form-->
           </div> <!-- end column-->
        </div> <!-- end row-->
      </div><!-- end card body-->
    </div> <!-- end card--->
