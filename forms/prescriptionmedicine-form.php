<?php
  require("../classes/database.php");
  require("../classes/prescriptionmedicine.php");
  require("../classes/prescription.php");
  require("../classes/medicine.php");
?>
<div class="card">
    <div class="card-header">
        <h3>Add PrescriptionMedicine</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <form method="post" id="form-add-prescriptionmedicine" onsubmit="PrescriptionMedicine.submitForm(event);">
                     <input type="hidden" name="id" id="id" value="0"/>
                    <div class="form-group m-3">
                        <label for="prescriptionId">Prescription</label>
                         <select class="form-control" name="prescriptionId" id="prescriptionId">
                        <?php
                            $prescription = new Prescription;
                            $records =$prescription->getAllRecords();
                            foreach($records as $mPrescription){
                                 echo'<option value="'.$mPrescription->getId().'">'.$mPrescription->getName().'</option>';
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
                    <div class="form-group m-3">
                        <label for="dosage">Dosage</label>
                        <textarea  id="dosage" class="form-control" name="dosage" placeholder="Enter Dosage" ></textarea>
                    </div>
                      <input type="submit" class="btn btn-primary" name="action_submit" value="Submit"/>
                  </form> <!-- end form-->
           </div> <!-- end column-->
        </div> <!-- end row-->
      </div><!-- end card body-->
    </div> <!-- end card--->
