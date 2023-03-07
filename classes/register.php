<?php
 class Register {
    
    private $userType;

    //inject userType object into Register Class
    function __construct($userType){
        $this->userType=$userType;

    }


    /**
     * Function to register a new user
     * @param name : name of the individual user or the instituion
     * @param address : Address of the individual or the institution
     * @param email : Email address of the individual or institution
     * @param password : Password of the invidual or instituation
     * @param confirmPassword : the confirmed password, must match password
     * @param usertype : The type of user signing up. The type can be one of the following
     *                   - Patient
     *                   - Manufacturer
     *                   - Retailer
     *                   - Hospital 
     *                   - Wholesaler                  
     * @return array containing the status and the message. 
     *          status: can be success or failure
     *          message: add more details of the status
     *          
     */
    function registerUser($name,$address,$email,$username,$userTypeId,$password,$confirmPassword){
        $status = 'success';
        $message = 'Account created successfully!';

        if(empty($name)){
            $status="failed";
            $message="Name is required";
            return array("status"=>$status,"message"=>$message);
        }

        if(empty($address)){
            $status="failed";
            $message="Address is required";
            return array("status"=>$status,"message"=>$message);
        }

        if(empty($email)){
            $status="failed";
            $message="Email is required";
            return array("status"=>$status,"message"=>$message);
        }

        if(empty($username)){
            $status="failed";
            $message="Username is required";
            return array("status"=>$status,"message"=>$message);
        }

        if(empty($userTypeId)){
            $status="failed";
            $message="User Type is required";
            return array("status"=>$status,"message"=>$message);
        }

        if(empty($password)){
            $status="failed";
            $message="Password is required";
            return array("status"=>$status,"message"=>$message);
        }

        //validate name
        if (!preg_match("/^[a-zA-Z][a-zA-Z-' .]+$/",$name)) {
            $status="failed";
            $message="Only letters and or white space is allowed in the name";
            return array("status"=>$status,"message"=>$message);
        }

        
        //validate name
        if (!preg_match("/^[a-zA-Z][a-zA-Z0-9]+$/",$username)) {
            $status="failed";
            $message="Only letters and numbers are allowed in the name. However, it can only start with a letter";
            return array("status"=>$status,"message"=>$message);
        }

        //validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $status="failed";
            $message="Email is not in correct form";
            return array("status"=>$status,"message"=>$message);
        }

        //validate user type Id
        if ((int)$userTypeId == 0) {
            $status="failed";
            $message="The user type entered is invalid";
            return array("status"=>$status,"message"=>$message);
        }
        
        
        //check if typed passwords match
        if($password!=$confirmPassword){
            $status ='failed';
            $message="Passwords do not match";
            return array("status"=>$status,"message"=>$message);
        }

        $hashedPassword = password_hash($password,PASSWORD_DEFAULT);

        //check if email is in use

        $sql="SELECT `Email` FROM `user` WHERE `Email`='$email'";
        $query = Database::getConnection()->query($sql);
        if($query->num_rows >0){
            $status="failed";
            $message="The email is already in use.";
            return array("status"=>$status,"message"=>$message); 
        }
        
        //check if username is already in use
        $sql="SELECT `Username` FROM `user` WHERE `Username`='$username'";
        $query = Database::getConnection()->query($sql);
        if($query->num_rows >0){
            $status="failed";
            $message="The username is already in use.";
            return array("status"=>$status,"message"=>$message); 
        }


        $sql = "INSERT INTO `user`( `Name`, `Address`, `Email`, `Username`, `password`, `User_Type_ID`) VALUES ('$name','$address','$email','$username','$hashedPassword','$userTypeId')";

        $query = Database::getConnection()->query($sql);
        if(!$query || Database::getConnection()->affected_rows ==0 ){
            $status ='failed';
            $message="Sorry, we failed to create the account";
        }

        return array("status"=>$status,"message"=>$message);
    }

    function getUserTypes(){
        return $this->userType->getUserTypes();
    }


 }