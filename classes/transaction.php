<?php
class Transaction{
  private $id;
  private $dateOfTransaction;
  private $details;
  private $location;
  private $transactionTypeId;

//Constructor function, creates a new instance of transaction; 
function __construct($id=null){
    if($id!=null){
        try{
            $sql="SELECT * FROM transaction WHERE ID=?";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("i",$id);
            $stmt->execute();
            $query = $stmt->get_result();
            if($query){
                while($row=$query->fetch_assoc()){
                    $this->setId($row['ID']);
                    $this->setDateOfTransaction($row['Date_Of_Transaction']);
                    $this->setDetails($row['Details']);
                    $this->setLocation($row['Location']);
                    $this->setTransactionTypeId($row['Transaction_Type_ID']);
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
            $sql="SELECT * FROM transaction WHERE 1";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->execute();
            $query = $stmt->get_result();
            if($query){
                while($row=$query->fetch_assoc()){
                    $mTransaction= new Transaction;
                    $mTransaction->setId($row['ID']);
                    $mTransaction->setDateOfTransaction($row['Date_Of_Transaction']);
                    $mTransaction->setDetails($row['Details']);
                    $mTransaction->setLocation($row['Location']);
                    $mTransaction->setTransactionTypeId($row['Transaction_Type_ID']);
                    $records[]=$mTransaction;
                }//end while
            }//end query check
          }catch(Exception $exception){
            throw $exception;
          }//end catch
        return $records;
    }//end getAllRecords function

//function to create or edit instance of transaction
function saveTransaction($id,$dateOfTransaction,$details,$location,$transactionTypeId){
    try{
        //if id is null then we are saving a new record
        if((int)$id==0){
            $sql="INSERT INTO `transaction`(`ID`,`Date_Of_Transaction`,`Details`,`Location`,`Transaction_Type_ID`) VALUES(?,?,?,?,?)";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("issss",$id,$dateOfTransaction,$details,$location,$transactionTypeId);
        }else{
            $sql="UPDATE `transaction` SET `Date_Of_Transaction`=?,`Details`=?,`Location`=?,`Transaction_Type_ID`=? WHERE ID=?";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("ssssi",$dateOfTransaction,$details,$location,$transactionTypeId,$id);
        }//end id null check
        $stmt->execute();
        $stmt->store_result();
        $id = $stmt->insert_id==null?$id:$stmt->insert_id;
        $stmt->close();
        return new Transaction($id); 
    }catch(Exception $exception){
        throw $exception;
    }
}//end save function


    function getId(){
          return $this->id;
      }

    function getDateOfTransaction(){
          return $this->dateOfTransaction;
      }

    function getDetails(){
          return $this->details;
      }

    function getLocation(){
          return $this->location;
      }

    function getTransactionTypeId(){
          return $this->transactionTypeId;
      }

    function getTransactionType(){
          return new TransactionType($this->transactionTypeId);
      }


    function setId($id){
          $this->id=$id;
      }


    function setDateOfTransaction($dateOfTransaction){
          $this->dateOfTransaction=$dateOfTransaction;
      }


    function setDetails($details){
          $this->details=$details;
      }


    function setLocation($location){
          $this->location=$location;
      }


    function setTransactionTypeId($transactionTypeId){
          $this->transactionTypeId=$transactionTypeId;
      }


      /**
      * Function to give a name to an object
      * @return string : name of object
      **/
    function __toString(){
        $names = [];   
        $names[]=$this->details; 
        return implode(" ",$names);
    }




}//end class
