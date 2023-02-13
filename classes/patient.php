<?php
class Patient{
  private $id;
  private $name;
  private $dateOfBirth;
  private $gender;
  private $User ID;

//Constructor function, creates a new instance of patient; 
function __construct($id=null){
    if($id!=null){
        try{
            $sql="SELECT * FROM patient WHERE ID=?";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("i",$id);
            $stmt->execute();
            $query = $stmt->get_result();
            if($query){
                while($row=$query->fetch_assoc()){
                    $this->setId($row['ID']);
                    $this->setName($row['Name']);
                    $this->setDateOfBirth($row['Date_Of_Birth']);
                    $this->setGender($row['Gender']);
                    $this->setUser ID($row['User_ID']);
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
            $sql="SELECT * FROM patient WHERE 1";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->execute();
            $query = $stmt->get_result();
            if($query){
                while($row=$query->fetch_assoc()){
                    $mPatient= new Patient;
                    $mPatient->setId($row['ID']);
                    $mPatient->setName($row['Name']);
                    $mPatient->setDateOfBirth($row['Date_Of_Birth']);
                    $mPatient->setGender($row['Gender']);
                    $mPatient->setUser ID($row['User_ID']);
                    $records[]=$mPatient;
                }//end while
            }//end query check
          }catch(Exception $exception){
            throw $exception;
          }//end catch
        return $records;
    }//end getAllRecords function

//function to create or edit instance of patient
function savePatient($id,$name,$dateOfBirth,$gender,$User ID){
    try{
        //if id is null then we are saving a new record
        if((int)$id==0){
            $sql="INSERT INTO `patient`(`ID`,`Name`,`Date_Of_Birth`,`Gender`,`User_ID`) VALUES(?,?,?,?,?)";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("isssi",$id,$name,$dateOfBirth,$gender,$User ID);
        }else{
            $sql="UPDATE `patient` SET `Name`=?,`Date_Of_Birth`=?,`Gender`=?,`User_ID`=? WHERE ID=?";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("sssii",$name,$dateOfBirth,$gender,$User ID,$id);
        }//end id null check
        $stmt->execute();
        $stmt->store_result();
        $id = $stmt->insert_id==null?$id:$stmt->insert_id;
        $stmt->close();
        return new Patient($id); 
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

    function getDateOfBirth(){
          return $this->dateOfBirth;
      }

    function getGender(){
          return $this->gender;
      }

    function getUser ID(){
          return $this->User ID;
      }

    function getUser(){
          return new User($this->User ID);
      }


    function setId($id){
          $this->id=$id;
      }


    function setName($name){
          $this->name=$name;
      }


    function setDateOfBirth($dateOfBirth){
          $this->dateOfBirth=$dateOfBirth;
      }


    function setGender($gender){
          $this->gender=$gender;
      }


    function setUser ID($User ID){
          $this->User ID=$User ID;
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




}//end class
