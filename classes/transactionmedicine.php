<?php
class TransactionMedicine{
  private $id;
  private $transactionId;
  private $medicineId;
  private $details;
  private $quantity;
  private $amount;

//Constructor function, creates a new instance of transactionMedicine; 
function __construct($id=null){
    if($id!=null){
        try{
            $sql="SELECT * FROM transaction_medicine WHERE ID=?";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("i",$id);
            $stmt->execute();
            $query = $stmt->get_result();
            if($query){
                while($row=$query->fetch_assoc()){
                    $this->setId($row['ID']);
                    $this->setTransactionId($row['Transaction_ID']);
                    $this->setMedicineId($row['Medicine_ID']);
                    $this->setDetails($row['Details']);
                    $this->setQuantity($row['Quantity']);
                    $this->setAmount($row['Amount']);
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
            $sql="SELECT * FROM transaction_medicine WHERE 1";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->execute();
            $query = $stmt->get_result();
            if($query){
                while($row=$query->fetch_assoc()){
                    $mTransactionMedicine= new TransactionMedicine;
                    $mTransactionMedicine->setId($row['ID']);
                    $mTransactionMedicine->setTransactionId($row['Transaction_ID']);
                    $mTransactionMedicine->setMedicineId($row['Medicine_ID']);
                    $mTransactionMedicine->setDetails($row['Details']);
                    $mTransactionMedicine->setQuantity($row['Quantity']);
                    $mTransactionMedicine->setAmount($row['Amount']);
                    $records[]=$mTransactionMedicine;
                }//end while
            }//end query check
          }catch(Exception $exception){
            throw $exception;
          }//end catch
        return $records;
    }//end getAllRecords function

//function to create or edit instance of transactionMedicine
function saveTransactionMedicine($id,$transactionId,$medicineId,$details,$quantity,$amount){
    try{
        //if id is null then we are saving a new record
        if((int)$id==0){
            $sql="INSERT INTO `transaction_medicine`(`ID`,`Transaction_ID`,`Medicine_ID`,`Details`,`Quantity`,`Amount`) VALUES(?,?,?,?,?,?)";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("iiisid",$id,$transactionId,$medicineId,$details,$quantity,$amount);
        }else{
            $sql="UPDATE `transaction_medicine` SET `Transaction_ID`=?,`Medicine_ID`=?,`Details`=?,`Quantity`=?,`Amount`=? WHERE ID=?";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("iisidi",$transactionId,$medicineId,$details,$quantity,$amount,$id);
        }//end id null check
        $stmt->execute();
        $stmt->store_result();
        $id = $stmt->insert_id==null?$id:$stmt->insert_id;
        $stmt->close();
        return new TransactionMedicine($id); 
    }catch(Exception $exception){
        throw $exception;
    }
}//end save function


    function getId(){
          return $this->id;
      }

    function getTransactionId(){
          return $this->transactionId;
      }

    function getTransaction(){
          return new Transaction($this->transactionId);
      }

    function getMedicineId(){
          return $this->medicineId;
      }

    function getMedicine(){
          return new Medicine($this->medicineId);
      }

    function getDetails(){
          return $this->details;
      }

    function getQuantity(){
          return $this->quantity;
      }

    function getAmount(){
          return $this->amount;
      }


    function setId($id){
          $this->id=$id;
      }


    function setTransactionId($transactionId){
          $this->transactionId=$transactionId;
      }


    function setMedicineId($medicineId){
          $this->medicineId=$medicineId;
      }


    function setDetails($details){
          $this->details=$details;
      }


    function setQuantity($quantity){
          $this->quantity=$quantity;
      }


    function setAmount($amount){
          $this->amount=$amount;
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
