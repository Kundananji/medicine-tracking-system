<?php
class TypeOfTransaction{
  private $id;
  private $name ;
  private $description;

//Constructor function, creates a new instance of typeOfTransaction; 
function __construct($id=null){
    if($id!=null){
        try{
            $sql="SELECT * FROM type_of_transaction WHERE ID=?";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("i",$id);
            $stmt->execute();
            $query = $stmt->get_result();
            if($query){
                while($row=$query->fetch_assoc()){
                    $this->setId($row['ID']);
                    $this->setName ($row['Name']);
                    $this->setDescription($row['Description']);
                }//end while
            }//end query check
          }catch(Exception $exception){
            throw $exception;
          }//end catch
        }//end id check
    }//end constructor



/**
* Function to fetch transaction by name
* @return transactionType 
* Function to fetch all records 
**/
function getByName($name){
    $mTypeOfTransaction=null;
        try{
            $sql="SELECT * FROM type_of_transaction WHERE `Name`='$name'";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->execute();
            $query = $stmt->get_result();
            if($query){
                while($row=$query->fetch_assoc()){
                    $mTypeOfTransaction= new TypeOfTransaction;
                    $mTypeOfTransaction->setId($row['ID']);
                    $mTypeOfTransaction->setName ($row['Name']);
                    $mTypeOfTransaction->setDescription($row['Description']);
         
                }//end while
            }//end query check
          }catch(Exception $exception){
            throw $exception;
          }//end catch
        return $mTypeOfTransaction;
}//end get by name function    


/**
* Function to fetch all records 
* @return array of fetched records 
* Function to fetch all records 
**/
function getAllRecords(){
    $records = [];//empty array of records
        try{
            $sql="SELECT * FROM type_of_transaction WHERE 1";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->execute();
            $query = $stmt->get_result();
            if($query){
                while($row=$query->fetch_assoc()){
                    $mTypeOfTransaction= new TypeOfTransaction;
                    $mTypeOfTransaction->setId($row['ID']);
                    $mTypeOfTransaction->setName ($row['Name']);
                    $mTypeOfTransaction->setDescription($row['Description']);
                    $records[]=$mTypeOfTransaction;
                }//end while
            }//end query check
          }catch(Exception $exception){
            throw $exception;
          }//end catch
        return $records;
}//end getAllRecords function

//function to create or edit instance of typeOfTransaction
function saveTypeOfTransaction($id,$name ,$description){
    try{
        //if id is null then we are saving a new record
        if((int)$id==0){
            $sql="INSERT INTO `type_of_transaction`(`ID`,`Name`,`Description`) VALUES(?,?,?)";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("iss",$id,$name ,$description);
        }else{
            $sql="UPDATE `type_of_transaction` SET `Name`=?,`Description`=? WHERE ID=?";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("ssi",$name ,$description,$id);
        }//end id null check
        $stmt->execute();
        $stmt->store_result();
        $id = $stmt->insert_id==null?$id:$stmt->insert_id;
        $stmt->close();
        return new TypeOfTransaction($id); 
    }catch(Exception $exception){
        throw $exception;
    }
}//end save function


    function getId(){
          return $this->id;
      }

    function getName (){
          return $this->name ;
      }

    function getDescription(){
          return $this->description;
      }


    function setId($id){
          $this->id=$id;
      }


    function setName ($name ){
          $this->name =$name ;
      }


    function setDescription($description){
          $this->description=$description;
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
