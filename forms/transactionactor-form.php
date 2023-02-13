<?php
  require("../classes/database.php");
  require("../classes/transactionactor.php");
  require("../classes/user.php");
  require("../classes/transactionrole.php");
?>
<div class="card">
    <div class="card-header">
        <h3>Add TransactionActor</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <form method="post" id="form-add-transactionactor" onsubmit="TransactionActor.submitForm(event);">
                     <input type="hidden" name="id" id="id" value="0"/>
                    <div class="form-group m-3">
                        <label for="userId ">User</label>
                         <select class="form-control" name="userId " id="userId ">
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
                        <label for="transactionRoleId">Transaction Role</label>
                         <select class="form-control" name="transactionRoleId" id="transactionRoleId">
                        <?php
                            $transactionRole = new TransactionRole;
                            $records =$transactionRole->getAllRecords();
                            foreach($records as $mTransactionRole){
                                 echo'<option value="'.$mTransactionRole->getId().'">'.$mTransactionRole->getName().'</option>';
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
