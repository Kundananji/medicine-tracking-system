<?php
  require("../classes/database.php");
  require("../classes/transaction.php");
  require("../classes/transactiontype.php");
?>
<div class="card">
    <div class="card-header">
        <h3>Add Transaction</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <form method="post" id="form-add-transaction" onsubmit="Transaction.submitForm(event);">
                     <input type="hidden" name="id" id="id" value="0"/>
                    <div class="form-group m-3">
                        <label for="dateOfTransaction">Date of Transaction</label>
                        <input type="date"  id="dateOfTransaction" class="form-control" name="dateOfTransaction" placeholder="Enter Date of Transaction"  required/>
                    </div>
                    <div class="form-group m-3">
                        <label for="details">Details</label>
                        <textarea  id="details" class="form-control" name="details" placeholder="Enter Details"  required></textarea>
                    </div>
                    <div class="form-group m-3">
                        <label for="location">Location</label>
                        <input type="text"  id="location" class="form-control" name="location" placeholder="Enter Location"  required/>
                    </div>
                    <div class="form-group m-3">
                        <label for="transactionTypeId">Transaction Type</label>
                         <select class="form-control" name="transactionTypeId" id="transactionTypeId">
                        <?php
                            $transactionType = new TransactionType;
                            $records =$transactionType->getAllRecords();
                            foreach($records as $mTransactionType){
                                 echo'<option value="'.$mTransactionType->getId().'">'.$mTransactionType->getName().'</option>';
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
