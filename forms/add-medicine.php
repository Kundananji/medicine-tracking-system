<?php
session_start();
include('../classes/database.php');
include('../classes/user.php');
include('../classes/manufacturer.php');

$manufacturer = new Manufacturer();
$manufacturers = $manufacturer->getUsers();


?>

<div class="card">
<div class="card-header">
    <h3>Add Medicine</h3>
</div>
<div class="card-body">

<div class="row">
    <div class="col">
        <form id="form-add-medicine" method="post">
            <div class="form-group m-3">
                <label for="name">Name of Medicine</label>
                <input type="text" name="name" class="form-control" placeholder="Name of Medicine" id="name" required/>
            </div>

            <div class="form-group m-3">
                <label for="description">Description of Medicine</label>
                <textarea class="form-control" name="description" placeholder="Description" id="description" required></textarea>
            </div>

            <div class="form-group m-3">
                <label for="manufacturedDate">Manufactured Date</label>
                <input type="date" class="form-control" name="manufacturedDate" placeholder="Manufactured Date" id="manufacturedDate" required/>
            </div>

            <div class="form-group m-3">
                <label for="expiryDate">Expiry Date</label>
                <input type="date" class="form-control" name="expiryDate" placeholder="Expiry Date" id="expiryDate" required/>
            </div>

            <div class="form-group m-3">
                <label for="gtin">GTIN</label>
                <input type="text" class="form-control" name="gtin" placeholder="GTIN" id="gtin"/>
            </div>

            <div class="form-group m-3">
                <label for="serial Number">Serial Number</label>
                <input type="text" class="form-control" name="serialNumber" placeholder="Serial Number" id="serialNumber"/>
            </div>



            <div class="form-group m-3">
                <label for="name">LOT Number</label>
                <input type="text" class="form-control" name="lotNumber" placeholder="LOT Number" id="lotNumber"/>
            </div>

            <div class="form-group m-3">
                <label for="name">Package Details</label>
                <input type="text" class="form-control" name="packageDetails" placeholder="Package Details" id="packageDetails"/>
            </div>

            <div class="form-group m-3">
                <label for="manufacturerId">Manufacturer</label>
                <select class="form-control" name="manufacturerId" id="manufacturerId">
                    <option value="">--Select Manufacturer--</option>
                    <?php
                    
       
                     foreach($manufacturers as $thisManufacturer){
                       echo'<option value="'.$thisManufacturer->getId().'" '.(isset($_SESSION['userTypeId']) && $_SESSION['userTypeId']==$thisManufacturer->getUserTypeId() && $_SESSION['userId'] == $thisManufacturer->getId()?" selected":"").'>'.$thisManufacturer->getName().'</option>';
                     }


                    ?>
                </select>

            </div>
             
            <input type="submit" name="action" value="Save Medicine" class="btn btn-primary"/>
        </form>
    </div>
</div>
</div><!-- end card body-->
</div> <!-- end card--->