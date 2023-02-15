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



//function to create or edit instance of transaction
/**
 * @param actors array of actors consising of user Id and role name in format
 * @param medicines array of medicines
 * 
 * 
 */
function createTransaction($dateOfTransaction,
                           $details,
                           $location,
                           $transactionTypeName, 
                           $actors,
                           $medicines){
    try{

        //create transaction first
        $id=0;
        $trasactionType = new TypeOfTransaction();
        $mTransactionType = $trasactionType->getByName($transactionTypeName);

        if($mTransactionType==null){
            throw new Exception("Could not find Transaction Type");
        }

        $createdTransaction = $this->saveTransaction($id,$dateOfTransaction,$details,$location,$mTransactionType->getId());
        
        if($createdTransaction==null){
          throw new Exception("Failed to create Transaction");
        }

        $transactionActor = new TransactionActor();
        
        //register actors
        foreach($actors as $actor){
            $transactionRole = new TransactionRole();

            $mTransactionRole = $transactionRole->getTransactionRoleByName($actor['roleName']);
            if($mTransactionRole == null){
                throw new Exception("Transaction Role not found");
            }

            $savedTransactionActor = $transactionActor->saveTransactionActor($id,$actor['userId'] ,$mTransactionRole->getId(),$createdTransaction->getId());

            if($savedTransactionActor == null){
                throw new Exception("Failed to save transaction actor");
            }
        }

        //register medicines
        $transactionMedicine = new TransactionMedicine();
        foreach($medicines as $medicine){
            $savedTransactionMedicine = $transactionMedicine->saveTransactionMedicine(0,$createdTransaction->getId(),$medicine['medicineId'],$medicine['details'],$medicine['quantity'],$medicine['amount']);
            if($savedTransactionMedicine == null){
                throw new Exception("Failed to save transaction medicine");
            }

        }



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
