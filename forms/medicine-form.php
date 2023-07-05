<?php
  session_start();
  $userId =$_SESSION['userId'];
  require("../classes/database.php");
  require("../classes/medicine.php");
  require("../classes/user.php");
  require("../classes/manufacturer.php");
  $medicine=null;
  if(isset($_GET['id'])){
    $id=trim(filter_var($_GET['id'],FILTER_SANITIZE_STRING));

    $medicine = new Medicine($id);
  }
?>
<div class="card">
    <div class="card-header">
        <h3>Add Medicine</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <form method="post" id="form-add-medicine" onsubmit="Medicine.submitForm(event);">
                     <input type="hidden" name="id" id="id" value="<?php echo $medicine!=null?$medicine->getId():'';?>"/>
                    <div class="form-group m-3">
                        <label for="name">Name</label>
                        <input type="text"  id="name" class="form-control" name="name" placeholder="Enter Name" value="<?php echo $medicine!=null?$medicine->getName():'';?>" required/>
                    </div>
                    <div class="form-group m-3">
                        <label for="description">Description</label>
                        <textarea  id="description" class="form-control" name="description" placeholder="Enter Description"  required><?php echo $medicine!=null?$medicine->getDescription():'';?></textarea>
                    </div>
                    <div class="form-group m-3">
                        <label for="manufacturedDate">Manufactured Date</label>
                        <input type="date"  id="manufacturedDate" class="form-control" name="manufacturedDate" placeholder="Enter Manufactured Date" value="<?php echo $medicine!=null?$medicine->getManufacturedDate():'';?>"  required/>
                    </div>
                    <div class="form-group m-3">
                        <label for="expiryDate">Expiry Date</label>
                        <input type="date"  id="expiryDate" class="form-control" name="expiryDate" placeholder="Enter Expiry Date" value="<?php echo $medicine!=null?$medicine->getExpiryDate():'';?>"  required/>
                    </div>
                    <div class="form-group m-3">
                        <label for="gtin">GTIN</label>
                        <input type="text"  id="gtin" class="form-control" name="gtin" placeholder="Enter GTIN" value="<?php echo $medicine!=null?$medicine->getGtin():'';?>"/>
                    </div>
                    <div class="form-group m-3">
                        <label for="serialNumber">Serial Number</label>
                        <input type="text"  id="serialNumber" class="form-control" name="serialNumber" placeholder="Enter Serial Number" value="<?php echo $medicine!=null?$medicine->getSerialNumber():'';?>"  required/>
                    </div>
                    <div class="form-group m-3">
                        <label for="lotNumber">LOT Number</label>
                        <input type="text"  id="lotNumber" class="form-control" name="lotNumber" placeholder="Enter LOT Number" value="<?php echo $medicine!=null?$medicine->getLotNumber():'';?>"  required/>
                    </div>
                    <div class="form-group m-3">
                        <label for="packageDetails">Package Details</label>
                        <input type="text"  id="packageDetails" class="form-control" name="packageDetails" placeholder="Enter Package Details" value="<?php echo $medicine!=null?$medicine->getPackageDetails():'';?>" required/>
                    </div>
  
                      
                         <input type="hidden" name="manufacturerId" id="manufacturerId" value="<?php echo $userId;?>">
                        
                  
                      <input type="submit" class="btn btn-primary" name="action_submit" value="Submit"/>
                  </form> <!-- end form-->
           </div> <!-- end column-->
        </div> <!-- end row-->
      </div><!-- end card body-->
    </div> <!-- end card--->
