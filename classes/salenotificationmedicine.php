<?php
class SaleNotificationMedicine{
  private $id;
  private $saleNotificationId;
  private $medicineId;
  private $quantity;
  private $amount;

//Constructor function, creates a new instance of saleNotificationMedicine; 
function __construct($id=null){
    if($id!=null){
        try{
            $sql="SELECT * FROM sale_notification_medicine WHERE ID=?";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("i",$id);
            $stmt->execute();
            $query = $stmt->get_result();
            if($query){
                while($row=$query->fetch_assoc()){
                    $this->setId($row['ID']);
                    $this->setSaleNotificationId($row['Sale_Notification_ID']);
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
            $sql="SELECT * FROM sale_notification_medicine WHERE 1";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->execute();
            $query = $stmt->get_result();
            if($query){
                while($row=$query->fetch_assoc()){
                    $mSaleNotificationMedicine= new SaleNotificationMedicine;
                    $mSaleNotificationMedicine->setId($row['ID']);
                    $mSaleNotificationMedicine->setSaleNotificationId($row['Sale_Notification_ID']);
                    $mSaleNotificationMedicine->setMedicineId($row['Medicine_ID']);
                    $mSaleNotificationMedicine->setQuantity($row['Quantity']);
                    $mSaleNotificationMedicine->setAmount($row['Amount']);
                    $records[]=$mSaleNotificationMedicine;
                }//end while
            }//end query check
          }catch(Exception $exception){
            throw $exception;
          }//end catch
        return $records;
    }//end getAllRecords function

//function to create or edit instance of saleNotificationMedicine
function saveSaleNotificationMedicine($id,$saleNotificationId,$medicineId,$quantity,$amount){
    try{
        //if id is null then we are saving a new record
        if((int)$id==0){
            $sql="INSERT INTO `sale_notification_medicine`(`ID`,`Sale_Notification_ID`,`Medicine_ID`,`Quantity`,`Amount`) VALUES(?,?,?,?,?)";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("iiiid",$id,$saleNotificationId,$medicineId,$quantity,$amount);
        }else{
            $sql="UPDATE `sale_notification_medicine` SET `Sale_Notification_ID`=?,`Medicine_ID`=?,`Quantity`=?,`Amount`=? WHERE ID=?";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("iiidi",$saleNotificationId,$medicineId,$quantity,$amount,$id);
        }//end id null check
        $stmt->execute();
        $stmt->store_result();
        $id = $stmt->insert_id==null?$id:$stmt->insert_id;
        $stmt->close();
        return new SaleNotificationMedicine($id); 
    }catch(Exception $exception){
        throw $exception;
    }
}//end save function


    function getId(){
          return $this->id;
      }

    function getSaleNotificationId(){
          return $this->saleNotificationId;
      }

    function getSaleNotification(){
          return new SaleNotification($this->saleNotificationId);
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


    function setSaleNotificationId($saleNotificationId){
          $this->saleNotificationId=$saleNotificationId;
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
        $names[]=$this->saleNotificationId; 
        return implode(" ",$names);
    }




}//end class
