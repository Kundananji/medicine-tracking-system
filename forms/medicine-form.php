<?php
  require("../classes/database.php");
  require("../classes/medicine.php");
  require("../classes/user.php");
  require("../classes/manufacturer.php");
?>
<div class="card">
    <div class="card-header">
        <h3>Add Medicine</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <form method="post" id="form-add-medicine" onsubmit="Medicine.submitForm(event);">
                     <input type="hidden" name="id" id="id" value="0"/>
                    <div class="form-group m-3">
                        <label for="name">Name</label>
                        <input type="text"  id="name" class="form-control" name="name" placeholder="Enter Name"  required/>
                    </div>
                    <div class="form-group m-3">
                        <label for="description">Description</label>
                        <textarea  id="description" class="form-control" name="description" placeholder="Enter Description"  required></textarea>
                    </div>
                    <div class="form-group m-3">
                        <label for="manufacturedDate">Manufactured Date</label>
                        <input type="date"  id="manufacturedDate" class="form-control" name="manufacturedDate" placeholder="Enter Manufactured Date"  required/>
                    </div>
                    <div class="form-group m-3">
                        <label for="expiryDate">Expiry Date</label>
                        <input type="date"  id="expiryDate" class="form-control" name="expiryDate" placeholder="Enter Expiry Date"  required/>
                    </div>
                    <div class="form-group m-3">
                        <label for="gtin">GTIN</label>
                        <input type="text"  id="gtin" class="form-control" name="gtin" placeholder="Enter GTIN"  required/>
                    </div>
                    <div class="form-group m-3">
                        <label for="serialNumber">Serial Number</label>
                        <input type="text"  id="serialNumber" class="form-control" name="serialNumber" placeholder="Enter Serial Number"  required/>
                    </div>
                    <div class="form-group m-3">
                        <label for="lotNumber">LOT Number</label>
                        <input type="text"  id="lotNumber" class="form-control" name="lotNumber" placeholder="Enter LOT Number"  required/>
                    </div>
                    <div class="form-group m-3">
                        <label for="packageDetails">Package Details</label>
                        <input type="text"  id="packageDetails" class="form-control" name="packageDetails" placeholder="Enter Package Details"  required/>
                    </div>
                    <div class="form-group m-3">
                        <label for="manufacturerId">Manufacturer</label>
                         <select class="form-control" name="manufacturerId" id="manufacturerId">
                        <?php
                            $user = new Manufacturer();
                            $records =$user->getUsers();
                            foreach($records as $mUser){
                                 echo'<option value="'.$mUser->getId().'">'.$mUser->getName().'</option>';
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
