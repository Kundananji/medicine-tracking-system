<?php
class DeliveryNotificationMedicine{
  private $id;
  private $deliveryNotificationId;
  private $medicineId;
  private $quantity;
  private $amount;

//Constructor function, creates a new instance of deliveryNotificationMedicine; 
function __construct($id=null){
    if($id!=null){
        try{
            $sql="SELECT * FROM delivery_notification_medicine WHERE ID=?";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("i",$id);
            $stmt->execute();
            $query = $stmt->get_result();
            if($query){
                while($row=$query->fetch_assoc()){
                    $this->setId($row['ID']);
                    $this->setDeliveryNotificationId($row['Delivery_Notification_ID']);
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
            $sql="SELECT * FROM delivery_notification_medicine WHERE 1";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->execute();
            $query = $stmt->get_result();
            if($query){
                while($row=$query->fetch_assoc()){
                    $mDeliveryNotificationMedicine= new DeliveryNotificationMedicine;
                    $mDeliveryNotificationMedicine->setId($row['ID']);
                    $mDeliveryNotificationMedicine->setDeliveryNotificationId($row['Delivery_Notification_ID']);
                    $mDeliveryNotificationMedicine->setMedicineId($row['Medicine_ID']);
                    $mDeliveryNotificationMedicine->setQuantity($row['Quantity']);
                    $mDeliveryNotificationMedicine->setAmount($row['Amount']);
                    $records[]=$mDeliveryNotificationMedicine;
                }//end while
            }//end query check
          }catch(Exception $exception){
            throw $exception;
          }//end catch
        return $records;
    }//end getAllRecords function

//function to create or edit instance of deliveryNotificationMedicine
function saveDeliveryNotificationMedicine($id,$deliveryNotificationId,$medicineId,$quantity,$amount){
    try{
        //if id is null then we are saving a new record
        if((int)$id==0){
            $sql="INSERT INTO `delivery_notification_medicine`(`ID`,`Delivery_Notification_ID`,`Medicine_ID`,`Quantity`,`Amount`) VALUES(?,?,?,?,?)";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("iiiid",$id,$deliveryNotificationId,$medicineId,$quantity,$amount);
        }else{
            $sql="UPDATE `delivery_notification_medicine` SET `Delivery_Notification_ID`=?,`Medicine_ID`=?,`Quantity`=?,`Amount`=? WHERE ID=?";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("iiidi",$deliveryNotificationId,$medicineId,$quantity,$amount,$id);
        }//end id null check
        $stmt->execute();
        $stmt->store_result();
        $id = $stmt->insert_id==null?$id:$stmt->insert_id;
        $stmt->close();
        return new DeliveryNotificationMedicine($id); 
    }catch(Exception $exception){
        throw $exception;
    }
}//end save function


    function getId(){
          return $this->id;
      }

    function getDeliveryNotificationId(){
          return $this->deliveryNotificationId;
      }

    function getDeliveryNotification(){
          return new DeliveryNotification($this->deliveryNotificationId);
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


    function setDeliveryNotificationId($deliveryNotificationId){
          $this->deliveryNotificationId=$deliveryNotificationId;
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
        $names[]=$this->deliveryNotificationId; 
        return implode(" ",$names);
    }




}//end class
