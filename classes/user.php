<?php
class User implements \JsonSerializable{
  private $id;
  private $name;
  private $address;
  private $email;
  private $username;
  private $password;
  private $userTypeId;

//Constructor function, creates a new instance of user; 
function __construct($id=null){
    if($id!=null){
        try{
            $sql="SELECT * FROM user WHERE ID=?";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("i",$id);
            $stmt->execute();
            $query = $stmt->get_result();
            if($query){
                while($row=$query->fetch_assoc()){
                    $this->setId($row['ID']);
                    $this->setName($row['Name']);
                    $this->setAddress($row['Address']);
                    $this->setEmail($row['Email']);
                    $this->setUsername($row['Username']);
                    $this->setPassword($row['Password']);
                    $this->setUserTypeId($row['User_Type_ID']);
                }//end while
            }//end query check
          }catch(Exception $exception){
            throw $exception;
          }//end catch
        }//end id check
    }//end constructor


/**
* Function to fetch all records 
* @return array of fetched records 
* Function to fetch all records 
**/
function getAllRecords(){
    $records = [];//empty array of records
        try{
            $sql="SELECT * FROM user WHERE 1";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->execute();
            $query = $stmt->get_result();
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
                    $records[]=$mUser;
                }//end while
            }//end query check
          }catch(Exception $exception){
            throw $exception;
          }//end catch
        return $records;
    }//end getAllRecords function

//function to create or edit instance of user
function saveUser($id,$name,$address,$email,$username,$password,$userTypeId){
    try{
        //if id is null then we are saving a new record
        if((int)$id==0){
            $sql="INSERT INTO `user`(`ID`,`Name`,`Address`,`Email`,`Username`,`Password`,`User_Type_ID`) VALUES(?,?,?,?,?,?,?)";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("isssssi",$id,$name,$address,$email,$username,$password,$userTypeId);
        }else{
            $sql="UPDATE `user` SET `Name`=?,`Address`=?,`Email`=?,`Username`=?,`Password`=?,`User_Type_ID`=? WHERE ID=?";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("sssssii",$name,$address,$email,$username,$password,$userTypeId,$id);
        }//end id null check
        $stmt->execute();
        $stmt->store_result();
        $id = $stmt->insert_id==null?$id:$stmt->insert_id;
        $stmt->close();
        return new User($id); 
    }catch(Exception $exception){
        throw $exception;
    }
}//end save function


    function getId(){
          return $this->id;
      }

    function getName(){
          return $this->name;
      }

    function getAddress(){
          return $this->address;
      }

    function getEmail(){
          return $this->email;
      }

    function getUsername(){
          return $this->username;
      }

    function getPassword(){
          return $this->password;
      }

    function getUserTypeId(){
          return $this->userTypeId;
      }


    function setId($id){
          $this->id=$id;
      }


    function setName($name){
          $this->name=$name;
      }


    function setAddress($address){
          $this->address=$address;
      }


    function setEmail($email){
          $this->email=$email;
      }


    function setUsername($username){
          $this->username=$username;
      }


    function setPassword($password){
          $this->password=$password;
      }


    function setUserTypeId($userTypeId){
          $this->userTypeId=$userTypeId;
      }


      /**
      * Function to give a name to an object
      * @return string : name of object
      **/
    function __toString(){
        $names = [];   
        $names[]=$this->name; 
        return implode(" ",$names);
    }


    public function jsonSerialize(){
      return get_object_vars($this);
  
    }





}//end class
