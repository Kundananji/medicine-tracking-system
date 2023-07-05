<?php
session_start();
require("../classes/database.php");
require("../classes/prescription.php");
require("../classes/user.php");
?>
<div class="card">
  <div class="card-header">
    <h3>Add Prescription</h3>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col">
        <form method="post" id="form-add-notification" onsubmit="Prescription.submitForm(event);">
          <input type="hidden" name="id" id="id" value="0" />
          <input type="hidden" name="transactionType" id="transactionType" value="Prescription" />
          <div class="form-group m-3">
            <label for="prescriptionDate">Prescription Date</label>
            <input type="date" id="prescriptionDate" class="form-control" name="prescriptionDate" placeholder="Enter Prescription Date" required />
          </div>

          <!-- if you are dipsensing, you are the hopsital -->

          <input type="hidden" name="hospitalId" id="hospitalId" value="<?php echo $_SESSION['userId']; ?>">

          <div class="form-group m-3">
            <label for="patientId">Patient </label>
            <select class="form-control" name="patientId" id="patientId">
              <?php
              $user = new User;
              $records = $user->getPatients();
              foreach ($records as $mUser) {
                if ($mUser->getId() == $_SESSION['userId']) {
                  //you can't disense medicine to yourself
                  continue;
                }
                echo '<option value="' . $mUser->getId() . '">' . $mUser->getName() . '</option>';
              }
              ?>
            </select>
          </div>

          <div class="form-group m-3">
                        <label for="location">Location</label>
                        <input type="text"  onfocus="pickLocation(this)" id="location" class="form-control" name="location" placeholder="Enter Location"  required/>
                    </div>
          <hr>
          <h5>Add Medicines</h5>

          <div class="alert alert-info">
            <p>Specify the Medicines that were dispensed</p>
            <p>Search by name to add medicine, or by lot number (batch number) to add all the medicines in a particular batch</p>
          </div>

          <div id="added-medicines">

          </div>
          <div class="input-group mb-3">
            <input type="text" id="text-search-medicine" class="form-control" placeholder="Enter medicine name or Batch No." aria-label="Enter medicine name or Batch No." aria-describedby="basic-addon2">
            <div class="input-group-append">
              <button class="btn btn-outline-secondary" type="button" id="button-search-medicine" onclick="Medicine.searchMedicine()"><i class="bi bi-search"></i> Search</button>
            </div>
          </div>
          <div class="m-3" id="medicines-found">

          </div>
          <div id="submit-feedback">

          </div>
          <input type="submit" class="btn btn-primary" name="action_submit" value="Submit" />
        </form> <!-- end form-->
      </div> <!-- end column-->
    </div> <!-- end row-->
  </div><!-- end card body-->
</div> <!-- end card--->