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

        if($password!=$confirmPassword){
            $status ='failed';
            $message="Passwords do not match";
        }

        $sql = "INSERT INTO `user`( `Name`, `Address`, `Email`, `Username`, `password`, `User_Type_ID`) VALUES ('$name','$address','$email','$username','$password','$userTypeId')";

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