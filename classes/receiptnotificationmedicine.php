<?php
class ReceiptNotificationMedicine{
  private $id;
  private $receiptNotificationId;
  private $medicineId;
  private $quantity;
  private $amount;

//Constructor function, creates a new instance of receiptNotificationMedicine; 
function __construct($id=null){
    if($id!=null){
        try{
            $sql="SELECT * FROM receipt_notification_medicine WHERE ID=?";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("i",$id);
            $stmt->execute();
            $query = $stmt->get_result();
            if($query){
                while($row=$query->fetch_assoc()){
                    $this->setId($row['ID']);
                    $this->setReceiptNotificationId($row['Receipt_Notification_ID']);
                    $this->setMedicineId($row['Medicine_ID']);
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
            $sql="SELECT * FROM receipt_notification_medicine WHERE 1";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->execute();
            $query = $stmt->get_result();
            if($query){
                while($row=$query->fetch_assoc()){
                    $mReceiptNotificationMedicine= new ReceiptNotificationMedicine;
                    $mReceiptNotificationMedicine->setId($row['ID']);
                    $mReceiptNotificationMedicine->setReceiptNotificationId($row['Receipt_Notification_ID']);
                    $mReceiptNotificationMedicine->setMedicineId($row['Medicine_ID']);
                    $mReceiptNotificationMedicine->setQuantity($row['Quantity']);
                    $mReceiptNotificationMedicine->setAmount($row['Amount']);
                    $records[]=$mReceiptNotificationMedicine;
                }//end while
            }//end query check
          }catch(Exception $exception){
            throw $exception;
          }//end catch
        return $records;
    }//end getAllRecords function

//function to create or edit instance of receiptNotificationMedicine
function saveReceiptNotificationMedicine($id,$receiptNotificationId,$medicineId,$quantity,$amount){
    try{
        //if id is null then we are saving a new record
        if((int)$id==0){
            $sql="INSERT INTO `receipt_notification_medicine`(`ID`,`Receipt_Notification_ID`,`Medicine_ID`,`Quantity`,`Amount`) VALUES(?,?,?,?,?)";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("iiiid",$id,$receiptNotificationId,$medicineId,$quantity,$amount);
        }else{
            $sql="UPDATE `receipt_notification_medicine` SET `Receipt_Notification_ID`=?,`Medicine_ID`=?,`Quantity`=?,`Amount`=? WHERE ID=?";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("iiidi",$receiptNotificationId,$medicineId,$quantity,$amount,$id);
        }//end id null check
        $stmt->execute();
        $stmt->store_result();
        $id = $stmt->insert_id==null?$id:$stmt->insert_id;
        $stmt->close();
        return new ReceiptNotificationMedicine($id); 
    }catch(Exception $exception){
        throw $exception;
    }
}//end save function


    function getId(){
          return $this->id;
      }

    function getReceiptNotificationId(){
          return $this->receiptNotificationId;
      }

    function getReceiptNotification(){
          return new ReceiptNotification($this->receiptNotificationId);
      }

    function getMedicineId(){
          return $this->medicineId;
      }

    function getMedicine(){
          return new Medicine($this->medicineId);
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


    function setReceiptNotificationId($receiptNotificationId){
          $this->receiptNotificationId=$receiptNotificationId;
      }


    function setMedicineId($medicineId){
          $this->medicineId=$medicineId;
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
        $names[]=$this->receiptNotificationId; 
        return implode(" ",$names);
    }




}//end class
