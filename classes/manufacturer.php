<?php 

class Manufacturer extends user{

    function getUsers(){
        $users = array();
        $sql ="SELECT `ID`, `Name`, `Address`, `Email`, `Username`, `Password`, `User_Type_ID` FROM `user` WHERE User_Type_ID =(SELECT ID FROM `user_type` WHERE `Name` ='Manufacturer')";
        $query = Database::getConnection()->query($sql);
        if($query){
            while($row=$query->fetch_assoc()){
                $mUser= new User;
                $mUser->setId($row['ID']);
                $mUser->setName($row['Name']);
                $mUser->setAddress($row['Address']);
                $mUser->setEmail($row['Email']);
                $mUser->setUsername($row['Username']);
                $mUser->setPassword($row['Password']);
                $mUser->setUserTypeId($row['User_Type_ID']);
               $users[]=$mUser;
            }
        }
      
        return $users;
    }

}