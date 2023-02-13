<?php
class TransactionActor{
  private $id;
  private $userId ;
  private $transactionRoleId;

//Constructor function, creates a new instance of transactionActor; 
function __construct($id=null){
    if($id!=null){
        try{
            $sql="SELECT * FROM transaction_actor WHERE ID=?";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("i",$id);
            $stmt->execute();
            $query = $stmt->get_result();
            if($query){
                while($row=$query->fetch_assoc()){
                    $this->setId($row['ID']);
                    $this->setUserId ($row['User_ID']);
                    $this->setTransactionRoleId($row['Transaction_Role_ID']);
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
            $sql="SELECT * FROM transaction_actor WHERE 1";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->execute();
            $query = $stmt->get_result();
            if($query){
                while($row=$query->fetch_assoc()){
                    $mTransactionActor= new TransactionActor;
                    $mTransactionActor->setId($row['ID']);
                    $mTransactionActor->setUserId ($row['User_ID']);
                    $mTransactionActor->setTransactionRoleId($row['Transaction_Role_ID']);
                    $records[]=$mTransactionActor;
                }//end while
            }//end query check
          }catch(Exception $exception){
            throw $exception;
          }//end catch
        return $records;
    }//end getAllRecords function

//function to create or edit instance of transactionActor
function saveTransactionActor($id,$userId ,$transactionRoleId){
    try{
        //if id is null then we are saving a new record
        if((int)$id==0){
            $sql="INSERT INTO `transaction_actor`(`ID`,`User_ID`,`Transaction_Role_ID`) VALUES(?,?,?)";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("iii",$id,$userId ,$transactionRoleId);
        }else{
            $sql="UPDATE `transaction_actor` SET `User_ID`=?,`Transaction_Role_ID`=? WHERE ID=?";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("iii",$userId ,$transactionRoleId,$id);
        }//end id null check
        $stmt->execute();
        $stmt->store_result();
        $id = $stmt->insert_id==null?$id:$stmt->insert_id;
        $stmt->close();
        return new TransactionActor($id); 
    }catch(Exception $exception){
        throw $exception;
    }
}//end save function


    function getId(){
          return $this->id;
      }

    function getUserId (){
          return $this->userId ;
      }

    function getActor(){
          return new User($this->userId );
      }

    function getTransactionRoleId(){
          return $this->transactionRoleId;
      }

    function getRole(){
          return new TransactionRole($this->transactionRoleId);
      }


    function setId($id){
          $this->id=$id;
      }


    function setUserId ($userId ){
          $this->userId =$userId ;
      }


    function setTransactionRoleId($transactionRoleId){
          $this->transactionRoleId=$transactionRoleId;
      }


      /**
      * Function to give a name to an object
      * @return string : name of object
      **/
    function __toString(){
        $names = [];   
        $names[]=$this->userId; 
        return implode(" ",$names);
    }




}//end class
