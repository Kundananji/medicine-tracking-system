<?php
class userType{
 private $id;
 private $name;
 private $description;

 /**
  * iitialize new user Type
  * @param id : id of user type
  * @param name : name of the user type
  * @param description: description of user type;
  */
 function __construct($id=null,$name=null,$description=null){
    $this->id=$id;
    $this->name=$name;
    $this->description=$description;
 }

 /**
  * function to get user types
  * @return array of user types
  *
  */
 function getUserTypes(){
    $userTypes = array();
    $sql="SELECT * FROM user_type ORDER BY name";
    $query = Database::getConnection()->query($sql);
    if($query){
        while($row=$query->fetch_assoc()){
            $userTypes[]=new UserType($row['ID'],$row['Name'],$row['Description']);
        }
    }
    return $userTypes;
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
}