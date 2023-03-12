<?php
class DeliveryNotificationMedicine{
  private $id;
  private $deliveryNotificationId;
  private $medicineId;
  private $quantity;


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
 
                }//end while
            }//end query check
          }catch(Exception $exception){
            throw $exception;
          }//end catch
        }//end id check
    }//end constructor


/**
* Function to fetch all records 
* @param deliveryNotificatinId : notification id to searcy by
* @return array of fetched records 
* Function to fetch all records 
**/
function getRecordsByDeliveryNotificationId($deliveryNotificationId){
    $records = [];//empty array of records
        try{
            $sql="SELECT * FROM delivery_notification_medicine WHERE Delivery_Notification_ID=?";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("i",$deliveryNotificationId);
            $stmt->execute();
            $query = $stmt->get_result();
            if($query){
                while($row=$query->fetch_assoc()){
                    $mDeliveryNotificationMedicine= new DeliveryNotificationMedicine;
                    $mDeliveryNotificationMedicine->setId($row['ID']);
                    $mDeliveryNotificationMedicine->setDeliveryNotificationId($row['Delivery_Notification_ID']);
                    $mDeliveryNotificationMedicine->setMedicineId($row['Medicine_ID']);
                    $mDeliveryNotificationMedicine->setQuantity($row['Quantity']);
                    $records[]=$mDeliveryNotificationMedicine;
                }//end while
            }//end query check
          }catch(Exception $exception){
            throw $exception;
          }//end catch
        return $records;
    }//end getAllRecords function


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
                    $records[]=$mDeliveryNotificationMedicine;
                }//end while
            }//end query check
          }catch(Exception $exception){
            throw $exception;
          }//end catch
        return $records;
    }//end getAllRecords function

//function to create or edit instance of deliveryNotificationMedicine
function saveDeliveryNotificationMedicine($id,$deliveryNotificationId,$medicineId,$quantity){
    try{
        //if id is null then we are saving a new record
        if((int)$id==0){
            $sql="INSERT INTO `delivery_notification_medicine`(`ID`,`Delivery_Notification_ID`,`Medicine_ID`,`Quantity`) VALUES(?,?,?,?)";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("iiii",$id,$deliveryNotificationId,$medicineId,$quantity);
        }else{
            $sql="UPDATE `delivery_notification_medicine` SET `Delivery_Notification_ID`=?,`Medicine_ID`=?,`Quantity`=? WHERE ID=?";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("iiii",$deliveryNotificationId,$medicineId,$quantity,$id);
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
