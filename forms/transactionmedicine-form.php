<?php
  require("../classes/database.php");
  require("../classes/transactionmedicine.php");
  require("../classes/transaction.php");
  require("../classes/medicine.php");
?>
<div class="card">
    <div class="card-header">
        <h3>Add TransactionMedicine</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <form method="post" id="form-add-transactionmedicine" onsubmit="TransactionMedicine.submitForm(event);">
                     <input type="hidden" name="id" id="id" value="0"/>
                    <div class="form-group m-3">
                        <label for="transactionId">Transaction</label>
                         <select class="form-control" name="transactionId" id="transactionId">
                        <?php
                            $transaction = new Transaction;
                            $records =$transaction->getAllRecords();
                            foreach($records as $mTransaction){
                                 echo'<option value="'.$mTransaction->getId().'">'.$mTransaction->getName().'</option>';
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
                        <label for="details">Details</label>
                        <textarea  id="details" class="form-control" name="details" placeholder="Enter Details"  required></textarea>
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
