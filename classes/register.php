<?php
 class Register extends userType{

    function __construct(){
        
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
    function registerUser($name,$address,$email,$userType,$password,$confirmPassword){
        $status = 'success';
        $message = 'Account created successfully!';

        return array("status"=>$status,"message"=>$message);
    }


 }