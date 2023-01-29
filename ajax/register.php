<?php
 include('../classes/database.php');
 include('../classes/user-type.php');
 include('../classes/register.php');

 $userType = new userType();

 $name=trim($_POST['name']);
 $address=trim($_POST['address']);
 $email=trim($_POST['email']);
 $username=trim($_POST['username']);
 $userTypeId=trim($_POST['userTypeId']);
 $password=trim($_POST['password']);
 $confirmPassword=trim($_POST['passwordConfirm']);

 $register = new Register($userType);

 $output = $register->registerUser($name,$address,$email,$username,$userTypeId,$password,$confirmPassword);
 
 echo json_encode($output);