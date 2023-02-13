<?php
  require("../classes/database.php");
  require("../classes/usertype.php");
?>
<div class="card">
    <div class="card-header">
        <h3>Add UserType</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <form method="post" id="form-add-usertype" onsubmit="UserType.submitForm(event);">
                     <input type="hidden" name="id" id="id" value="0"/>
                    <div class="form-group m-3">
                        <label for="name ">Name</label>
                        <input type="text"  id="name " class="form-control" name="name " placeholder="Enter Name"  required/>
                    </div>
                    <div class="form-group m-3">
                        <label for="description">Description</label>
                        <textarea  id="description" class="form-control" name="description" placeholder="Enter Description"  required></textarea>
                    </div>
                    <div class="form-group m-3">
                        <label for="canAddMedicine">Can Add Medicine</label>
                        <input type="number"  id="canAddMedicine" class="form-control" name="canAddMedicine" placeholder="Enter Can Add Medicine"  required/>
                    </div>
                    <div class="form-group m-3">
                        <label for="canViewMedicine">Can View Medicine</label>
                        <input type="number"  id="canViewMedicine" class="form-control" name="canViewMedicine" placeholder="Enter Can View Medicine"  required/>
                    </div>
                    <div class="form-group m-3">
                        <label for="canSale">Can Sale</label>
                        <input type="number"  id="canSale" class="form-control" name="canSale" placeholder="Enter Can Sale"  required/>
                    </div>
                    <div class="form-group m-3">
                        <label for="canBuy">Can Buy</label>
                        <input type="number"  id="canBuy" class="form-control" name="canBuy" placeholder="Enter Can Buy"  required/>
                    </div>
                    <div class="form-group m-3">
                        <label for="canReceive">Can Receive</label>
                        <input type="number"  id="canReceive" class="form-control" name="canReceive" placeholder="Enter Can Receive"  required/>
                    </div>
                    <div class="form-group m-3">
                        <label for="canDeliver">Can Deliver</label>
                        <input type="number"  id="canDeliver" class="form-control" name="canDeliver" placeholder="Enter Can Deliver"  required/>
                    </div>
                    <div class="form-group m-3">
                        <label for="canDispense">Can Dispense</label>
                        <input type="number"  id="canDispense" class="form-control" name="canDispense" placeholder="Enter Can Dispense"  required/>
                    </div>
                      <input type="submit" class="btn btn-primary" name="action_submit" value="Submit"/>
                  </form> <!-- end form-->
           </div> <!-- end column-->
        </div> <!-- end row-->
      </div><!-- end card body-->
    </div> <!-- end card--->
