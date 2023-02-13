<?php
  require("../classes/database.php");
  require("../classes/damagenotificationmedicine.php");
  require("../classes/damagenotification.php");
  require("../classes/medicine.php");
?>
<div class="card">
    <div class="card-header">
        <h3>Add DamageNotificationMedicine</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <form method="post" id="form-add-damagenotificationmedicine" onsubmit="DamageNotificationMedicine.submitForm(event);">
                     <input type="hidden" name="id" id="id" value="0"/>
                    <div class="form-group m-3">
                        <label for="damageNotificationId">Damage Notification</label>
                         <select class="form-control" name="damageNotificationId" id="damageNotificationId">
                        <?php
                            $damageNotification = new DamageNotification;
                            $records =$damageNotification->getAllRecords();
                            foreach($records as $mDamageNotification){
                                 echo'<option value="'.$mDamageNotification->getId().'">'.$mDamageNotification->getName().'</option>';
                               }
                         ?>
                         </select>
                    </div>
                    <div class="form-group m-3">
                        <label for="medicineId">Medicine</label>
                         <select class="form-control" name="medicineId" id="medicineId">
                        <?php
                            $medicine = new Medicine;
                            $records =$medicine->getAllRecords();
                            foreach($records as $mMedicine){
                                 echo'<option value="'.$mMedicine->getId().'">'.$mMedicine->getName().'</option>';
                               }
                         ?>
                         </select>
                    </div>
                    <div class="form-group m-3">
                        <label for="quantity">Quantity</label>
                        <input type="number"  id="quantity" class="form-control" name="quantity" placeholder="Enter Quantity"  required/>
                    </div>
                    <div class="form-group m-3">
                        <label for="amount">Amount</label>
                        <input type="number"  step="any" id="amount" class="form-control" name="amount" placeholder="Enter Amount"  required/>
                    </div>
                    <div class="form-group m-3">
                        <label for="details">Details of Damage</label>
                        <textarea  id="details" class="form-control" name="details" placeholder="Enter Details of Damage"  required></textarea>
                    </div>
                      <input type="submit" class="btn btn-primary" name="action_submit" value="Submit"/>
                  </form> <!-- end form-->
           </div> <!-- end column-->
        </div> <!-- end row-->
      </div><!-- end card body-->
    </div> <!-- end card--->
