<?php
class DeliveryNotification{
  private $id;
  private $dateOfDelivery;
  private $deliveredById;
  private $deliveredToId;
  private $location;

//Constructor function, creates a new instance of deliveryNotification; 
function __construct($id=null){
    if($id!=null){
        try{
            $sql="SELECT * FROM delivery_notification WHERE ID=?";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("i",$id);
            $stmt->execute();
            $query = $stmt->get_result();
            if($query){
                while($row=$query->fetch_assoc()){
                    $this->setId($row['ID']);
                    $this->setDateOfDelivery($row['Date_Of_Delivery']);
                    $this->setDeliveredById($row['Delivered_By_ID']);
                    $this->setDeliveredToId($row['Delivered_To_ID']);
                    $this->setLocation($row['Location']);
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
            $sql="SELECT * FROM delivery_notification WHERE 1";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->execute();
            $query = $stmt->get_result();
            if($query){
                while($row=$query->fetch_assoc()){
                    $mDeliveryNotification= new DeliveryNotification;
                    $mDeliveryNotification->setId($row['ID']);
                    $mDeliveryNotification->setDateOfDelivery($row['Date_Of_Delivery']);
                    $mDeliveryNotification->setDeliveredById($row['Delivered_By_ID']);
                    $mDeliveryNotification->setDeliveredToId($row['Delivered_To_ID']);
                    $mDeliveryNotification->setLocation($row['Location']);
                    $records[]=$mDeliveryNotification;
                }//end while
            }//end query check
          }catch(Exception $exception){
            throw $exception;
          }//end catch
        return $records;
    }//end getAllRecords function

//function to create or edit instance of deliveryNotification
function saveDeliveryNotification($id,$dateOfDelivery,$deliveredById,$deliveredToId,$location){
    try{
        //if id is null then we are saving a new record
        if((int)$id==0){
            $sql="INSERT INTO `delivery_notification`(`ID`,`Date_Of_Delivery`,`Delivered_By_ID`,`Delivered_To_ID`,`Location`) VALUES(?,?,?,?,?)";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("isiis",$id,$dateOfDelivery,$deliveredById,$deliveredToId,$location);
        }else{
            $sql="UPDATE `delivery_notification` SET `Date_Of_Delivery`=?,`Delivered_By_ID`=?,`Delivered_To_ID`=?,`Location`=? WHERE ID=?";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("siisi",$dateOfDelivery,$deliveredById,$deliveredToId,$location,$id);
        }//end id null check
        $stmt->execute();
        $stmt->store_result();
        $id = $stmt->insert_id==null?$id:$stmt->insert_id;
        $stmt->close();
        return new DeliveryNotification($id); 
    }catch(Exception $exception){
        throw $exception;
    }
}//end save function


    function getId(){
          return $this->id;
      }

    function getDateOfDelivery(){
          return $this->dateOfDelivery;
      }

    function getDeliveredById(){
          return $this->deliveredById;
      }

    function getDeliverer(){
          return new User($this->deliveredById);
      }

    function getDeliveredToId(){
          return $this->deliveredToId;
      }

    function getReceipient(){
          return new User($this->deliveredToId);
      }

    function getLocation(){
          return $this->location;
      }


    function setId($id){
          $this->id=$id;
      }


    function setDateOfDelivery($dateOfDelivery){
          $this->dateOfDelivery=$dateOfDelivery;
      }


    function setDeliveredById($deliveredById){
          $this->deliveredById=$deliveredById;
      }


    function setDeliveredToId($deliveredToId){
          $this->deliveredToId=$deliveredToId;
      }


    function setLocation($location){
          $this->location=$location;
      }


      /**
      * Function to give a name to an object
      * @return string : name of object
      **/
    function __toString(){
        $names = [];   
        $names[]=$this->deliveredToId; 
        return implode(" ",$names);
    }




}//end class
