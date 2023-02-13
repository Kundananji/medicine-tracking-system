<?php
class userType{
 private $id;
 private $name;
 private $description;
 private $canAddMedicine;
 private $canViewMedicine;
 private $canSale;
 private $canReceive;
 private $canDeliver;

 /**
  * initialize new user Type
  * @param id : id of user type
  * @param name : name of the user type
  * @param description: description of user type;
  */
 function __construct($id=null,$name=null,$description=null){
    $this->id=$id;
    $this->name=$name;
    $this->description=$description;
 }

 /***
  * function to get user types
  * @return array of user types
  *
  */
 function getUserTypes(){
    $userTypes = array();
    $sql="SELECT `ID`, `Name`, `Description`, `Can_Add_Medicine`, `Can_View_Medicine`, `Can_Sale`, `Can_Receive`, `Can_Deliver`, `Can_Dispense`, `Can_View_Report`, `Can_Report_Damage` FROM user_type ORDER BY name";
    $query = Database::getConnection()->query($sql);
    if($query){
        while($row=$query->fetch_assoc()){
            $mUserType=new UserType($row['ID'],$row['Name'],$row['Description']);
            $mUserType->setCanAddMedicine($row['Can_Add_Medicine']);
            $mUserType->setCanViewMedicine($row['Can_View_Medicine']);
            $mUserType->setCanSale($row['Can_Sale']);
            $userTypes[]=$mUserType;
        }
    }
    return $userTypes;
 }

 /**
  * function to get a user type object by the given type
  * @return userType object
  *
  */
 function getUserByTypeId(){
    $userType = null;
    $sql="SELECT `ID`, `Name`, `Description`, `Can_Add_Medicine`, `Can_View_Medicine`, `Can_Sale`, `Can_Receive`, `Can_Deliver`, `Can_Dispense`, `Can_View_Report`, `Can_Report_Damage` FROM user_type WHERE ID =".$this->id;
    $query = Database::getConnection()->query($sql);
    if($query){
        if($row=$query->fetch_assoc()){
            $userType=new UserType($row['ID'],$row['Name'],$row['Description']);
            $userType->setCanAddMedicine($row['Can_Add_Medicine']);
            $userType->setCanViewMedicine($row['Can_View_Medicine']);
            $userType->setCanSale($row['Can_Sale']);
        }
    }

    return $userType;
 }


 /**
  * Get the value of id
  */ 
 public function getId()
 {
  return $this->id;
 }

 /**
  * Set the value of id
  *
  * @return  self
  */ 
 public function setId($id)
 {
  $this->id = $id;

  return $this;
 }

 /**
  * Get the value of name
  */ 
 public function getName()
 {
  return $this->name;
 }

 /**
  * Set the value of name
  *
  * @return  self
  */ 
 public function setName($name)
 {
  $this->name = $name;

  return $this;
 }

 /**
  * Get the value of description
  */ 
 public function getDescription()
 {
  return $this->description;
 }

 /**
  * Set the value of description
  *
  * @return  self
  */ 
 public function setDescription($description)
 {
  $this->description = $description;

  return $this;
 }

 /**
  * Get the value of canAddMedicine
  */ 
 public function getCanAddMedicine()
 {
  return $this->canAddMedicine;
 }

 /**
  * Set the value of canAddMedicine
  *
  * @return  self
  */ 
 public function setCanAddMedicine($canAddMedicine)
 {
  $this->canAddMedicine = $canAddMedicine;

  return $this;
 }

 /**
  * Get the value of canViewMedicine
  */ 
 public function getCanViewMedicine()
 {
  return $this->canViewMedicine;
 }

 /**
  * Set the value of canViewMedicine
  *
  * @return  self
  */ 
 public function setCanViewMedicine($canViewMedicine)
 {
  $this->canViewMedicine = $canViewMedicine;

  return $this;
 }

 /**
  * Get the value of canSale
  */ 
 public function getCanSale()
 {
  return $this->canSale;
 }

 /**
  * Set the value of canSale
  *
  * @return  self
  */ 
 public function setCanSale($canSale)
 {
  $this->canSale = $canSale;

  return $this;
 }
}