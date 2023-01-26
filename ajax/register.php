<?php
 include('classes/database.php');
 include('classes/user-type.php');
 include('classes/register.php');

 $name=$_POST['name'];
 $address=$_POST['address'];
 $email=$_POST['email'];
 $userType=$_POST['userType'];
 $password=$_POST['password'];
 $confirmPassword=$_POST['confirmPassword'];

 $register = new Register();

 $output = $register->registerUser($name,$address,$email,$userType,$password,$confirmPassword);
 
 echo json_encode($output);