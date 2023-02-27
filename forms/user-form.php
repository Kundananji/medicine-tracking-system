<?php
  session_start();
  require("../classes/database.php");
  require("../classes/user.php");
  require("../classes/usertype.php");
  $userId = $_SESSION['userId'];

  $user = new User($userId);
?>
<div class="card">
    <div class="card-header">
        <h3>Update Account Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <form method="post" id="form-add-user" onsubmit="User.submitForm(event);">
                     <input type="hidden" name="id" id="id" value="<?php echo $user->getId();?>"/>
                     <input type="hidden" name="password" id="password" value="<?php echo $user->getPassword();?>"/>
                     <input type="hidden" name="userTypeId" id="userTypeId" value="<?php echo $user->getUserTypeId();?>"/>
                    <div class="form-group m-3">
                        <label for="name">Name</label>
                        <input type="text"  id="name" class="form-control" name="name" placeholder="Enter Name" value="<?php echo $user->getName();?>" required/>
                    </div>
                    <div class="form-group m-3">
                        <label for="address">Address</label>
                        <textarea  id="address" class="form-control" name="address" placeholder="Enter Address"  required><?php echo $user->getAddress();?></textarea>
                    </div>
                    <div class="form-group m-3">
                        <label for="email">Email</label>
                        <input type="text"  id="email" class="form-control" name="email" placeholder="Enter Email"  value="<?php echo $user->getEmail();?>" required/>
                    </div>
                    <div class="form-group m-3">
                        <label for="username">Username</label>
                        <input type="text"  id="username" class="form-control" name="username" placeholder="Enter Username"  required value="<?php echo $user->getUsername();?>"/>
                    </div>
          <?php
            if(strtolower($user->getUserType()->getName()) =="miner"){

          ?>
                    <div class="form-group m-3">
                        <label for="publicKey">Public Key</label>
                        <textarea  id="publicKey" class="form-control" name="publicKey" placeholder="Enter Public Key"><?php echo $user->getPublicKey();?></textarea>
                    </div>
                    <div class="form-group m-3">
                        <label for="ipAddress">IP Address</label>
                        <input type="text"  id="ipAddress" class="form-control" name="ipAddress" placeholder="Enter IP Address" value="<?php echo $user->getIpAddress();?>" />
                    </div>
        <?php
            }

         ?>
                      <input type="submit" class="btn btn-primary" id="action_submit_button" name="action_submit" value="Submit"/>
                      <div id="button-loader"></div>
                  </form> <!-- end form-->
           </div> <!-- end column-->
        </div> <!-- end row-->
      </div><!-- end card body-->
    </div> <!-- end card--->