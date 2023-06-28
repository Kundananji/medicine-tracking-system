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
        <h3>Update Mining Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <form method="post" id="form-add-user" onsubmit="User.submitForm(event);">
                    <input type="hidden" name="id" id="id" value="<?php echo $user->getId(); ?>" />
                    <input type="hidden" name="password" id="password" value="<?php echo $user->getPassword(); ?>" />
                    <input type="hidden" name="userTypeId" id="userTypeId" value="<?php echo $user->getUserTypeId(); ?>" />

                    <input type="hidden" id="name" name="name" value="<?php echo $user->getName(); ?>" />


                    <input type="hidden" id="address" name="address" value="<?php echo $user->getAddress(); ?>">


                    <input type="hidden" id="email" name="email" value="<?php echo $user->getEmail(); ?>" />


                    <input type="hidden" id="username" name="username" value="<?php echo $user->getUsername(); ?>" />

                    <?php
                    if (strtolower($user->getUserType()->getName()) == "miner") {

                    ?>
                        <div class="form-group m-3">
                            <label for="publicKey">Public Key</label>
                            <textarea id="publicKey" class="form-control" name="publicKey" placeholder="Enter Public Key"><?php echo $user->getPublicKey(); ?></textarea>
                        </div>
                        <div class="form-group m-3">
                            <label for="ipAddress">IP Address</label>
                            <input type="text" id="ipAddress" class="form-control" name="ipAddress" placeholder="Enter IP Address" value="<?php echo $user->getIpAddress(); ?>" />
                        </div>

                        <input type="submit" class="btn btn-primary m-3" id="action_submit_button" name="action_submit" value="Submit" />
                        <div id="button-loader"></div>
                    <?php
                    }

                    ?>
                </form> <!-- end form-->
            </div> <!-- end column-->
        </div> <!-- end row-->
    </div><!-- end card body-->
</div> <!-- end card--->