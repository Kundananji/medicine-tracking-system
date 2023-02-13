<?php
  require("../classes/database.php");
  require("../classes/transactionrole.php");
?>
<div class="card">
    <div class="card-header">
        <h3>Add TransactionRole</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <form method="post" id="form-add-transactionrole" onsubmit="TransactionRole.submitForm(event);">
                     <input type="hidden" name="id" id="id" value="0"/>
                    <div class="form-group m-3">
                        <label for="name ">Name</label>
                        <input type="text"  id="name " class="form-control" name="name " placeholder="Enter Name"  required/>
                    </div>
                    <div class="form-group m-3">
                        <label for="description">Description</label>
                        <textarea  id="description" class="form-control" name="description" placeholder="Enter Description"  required></textarea>
                    </div>
                      <input type="submit" class="btn btn-primary" name="action_submit" value="Submit"/>
                  </form> <!-- end form-->
           </div> <!-- end column-->
        </div> <!-- end row-->
      </div><!-- end card body-->
    </div> <!-- end card--->
