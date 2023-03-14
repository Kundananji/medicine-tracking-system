<?php
session_start();
require("../classes/database.php");
require("../classes/patient.php");
require("../classes/user.php");
?>
<div class="card">
    <div class="card-header">
        <h3>Add Patient</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <form method="post" id="form-add-patient" onsubmit="Patient.submitForm(event);">
                    <input type="hidden" name="id" id="id" value="0" />
                    <div class="form-group m-3">
                        <label for="name">Name</label>
                        <input type="text" id="name" class="form-control" name="name" placeholder="Enter Name" required />
                    </div>
                    <div class="form-group m-3">
                        <label for="dateOfBirth">Date of Birth</label>
                        <input type="date" id="dateOfBirth" class="form-control" name="dateOfBirth" placeholder="Enter Date of Birth" required />
                    </div>
                    <div class="form-group m-3">
                        <label for="gender">Gender</label>
                        <input type="text" id="gender" class="form-control" name="gender" placeholder="Enter Gender" required />
                    </div>
                    <div class="form-group m-3">
                        <label for="User ID">User</label>
                        <select class="form-control" name="User ID" id="User ID">
                            <?php
                            $user = new User;
                            $records = $user->getAllRecords();
                            foreach ($records as $mUser) {
                                echo '<option value="' . $mUser->getId() . '">' . $mUser->getName() . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <input type="submit" class="btn btn-primary" name="action_submit" value="Submit" />
                </form> <!-- end form-->
            </div> <!-- end column-->
        </div> <!-- end row-->
    </div><!-- end card body-->
</div> <!-- end card--->