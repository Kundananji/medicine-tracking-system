<?php
 include('classes/database.php');
 include('classes/user-type.php');
 include('classes/register.php');

 $userType = new userType();

 $name=$_POST['name'];
 $address=$_POST['address'];
 $email=$_POST['email'];
 $username=$_POST['username'];
 $userType=$_POST['userType'];
 $password=$_POST['password'];
 $confirmPassword=$_POST['confirmPassword'];

 $register = new Register($userType);

 $output = $register->registerUser($name,$address,$email,$username,$userTypeId,$password,$confirmPassword);
 
 echo json_encode($output);