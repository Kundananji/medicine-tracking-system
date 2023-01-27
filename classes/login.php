<?php
class Login{

    private $username;
    private $password;

    function __construct($username,$password){
        $this->username = $username;
        $this->password = $password;
    }

    function authenticateUser(){
        $sql="SELECT * FROM `user` WHERE Username =? OR Email =?";
        $stmt = Database::getConnection()->prepare($sql);
        $stmt->bind_param("s",$this->username);
        $stmt->execute();

        $result = $stmt->get_result();
        if(!$result){
            return false;
        }
    }
}