<?php
  require("../classes/database.php");
  require("../classes/salenotificationmedicine.php");
  require("../classes/salenotification.php");
  require("../classes/medicine.php");
?>
<div class="card">
    <div class="card-header">
        <h3>Add SaleNotificationMedicine</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <form method="post" id="form-add-salenotificationmedicine" onsubmit="SaleNotificationMedicine.submitForm(event);">
                     <input type="hidden" name="id" id="id" value="0"/>
                    <div class="form-group m-3">
                        <label for="saleNotificationId">Sale Notification</label>
                         <select class="form-control" name="saleNotificationId" id="saleNotificationId">
                        <?php
                            $saleNotification = new SaleNotification;
                            $records =$saleNotification->getAllRecords();
                            foreach($records as $mSaleNotification){
                                 echo'<option value="'.$mSaleNotification->getId().'">'.$mSaleNotification->getName().'</option>';
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
                      <input type="submit" class="btn btn-primary" name="action_submit" value="Submit"/>
                  </form> <!-- end form-->
           </div> <!-- end column-->
        </div> <!-- end row-->
      </div><!-- end card body-->
    </div> <!-- end card--->
