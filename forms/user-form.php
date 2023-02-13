<?php
  require("../classes/database.php");
  require("../classes/user.php");
  require("../classes/usertype.php");
?>
<div class="card">
    <div class="card-header">
        <h3>Add User</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <form method="post" id="form-add-user" onsubmit="User.submitForm(event);">
                     <input type="hidden" name="id" id="id" value="0"/>
                    <div class="form-group m-3">
                        <label for="name">Name</label>
                        <input type="text"  id="name" class="form-control" name="name" placeholder="Enter Name"  required/>
                    </div>
                    <div class="form-group m-3">
                        <label for="address">Address</label>
                        <textarea  id="address" class="form-control" name="address" placeholder="Enter Address"  required></textarea>
                    </div>
                    <div class="form-group m-3">
                        <label for="email">Email</label>
                        <input type="text"  id="email" class="form-control" name="email" placeholder="Enter Email"  required/>
                    </div>
                    <div class="form-group m-3">
                        <label for="username">Username</label>
                        <textarea  id="username" class="form-control" name="username" placeholder="Enter Username"  required></textarea>
                    </div>
                    <div class="form-group m-3">
                        <label for="password">Password</label>
                        <input type="password"  id="password" class="form-control" name="password" placeholder="Enter Password"  required/>
                    </div>
                    <div class="form-group m-3">
                        <label for="userTypeId">User Type</label>
                         <select class="form-control" name="userTypeId" id="userTypeId">
                        <?php
                            $userType = new UserType;
                            $records =$userType->getAllRecords();
                            foreach($records as $mUserType){
                                 echo'<option value="'.$mUserType->getId().'">'.$mUserType->getName().'</option>';
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
