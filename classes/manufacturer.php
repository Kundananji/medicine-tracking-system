<?php 

class Manufacturer extends user{

    function getUsers(){
        $users = array();
        $sql ="SELECT `ID`, `Name`, `Address`, `Email`, `Username`, `Password`, `User_Type_ID` FROM `user` WHERE User_Type_ID =(SELECT ID FROM `user_type` WHERE `Name` ='Manufacturer')";
        $query = Database::getConnection()->query($sql);
        if($query){
            while($row=$query->fetch_assoc()){
               $user = $this->extractUser($row);
               $users[]=$user;
            }
        }
      
        return $users;
    }

}