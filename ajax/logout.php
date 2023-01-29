<?php
session_start();
unset($_SESSION['userId']);
unset($_SESSION['userTypeId']);
unset($_SESSION['name']);
session_destroy();
echo json_encode(
    array(
        "status"=>"success",
        "message"=>"Successfully logged out"
    )
    );