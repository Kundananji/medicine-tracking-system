<?php
class Login{

    private $username;
    private $password;
    private $userId;
    private $userTypeId;
    private $name;

    function __construct($username,$password){
        $this->username = $username;
        $this->password = $password;
    }

    function authenticateUser(){
        $sql="SELECT `Password`,`User_Type_ID`,`ID`,`Name` FROM `user` WHERE Username =? OR Email =?";
        $stmt = Database::getConnection()->prepare($sql);
        $stmt->bind_param("ss",$this->username,$this->username);
        $stmt->execute();

        $result = $stmt->get_result();
        if(!$result){
            return false;
        }

        if($row = $result->fetch_assoc()){
            $hashedPassword = $row['Password'];
            $this->userId = $row['ID'];
            $this->userTypeId=$row['User_Type_ID'];
            $this->name = $row['Name'];
            //verify password
            if(password_verify($this->password,$hashedPassword)){
                return true;
            }
        }

        return false;
    }

    function initiateSession(){
        $_SESSION['userId']=$this->userId;
        $_SESSION['userTypeId']=$this->userTypeId;
        $_SESSION['name']=$this->name;
    }
}