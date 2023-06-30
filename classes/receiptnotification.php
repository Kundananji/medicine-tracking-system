<?php
class ReceiptNotification{
  private $id;
  private $dateOfReceipt;
  private $buyerId;
  private $sellerId;
  private $location;

//Constructor function, creates a new instance of receiptNotification; 
function __construct($id=null){
    if($id!=null){
        try{
            $sql="SELECT * FROM receipt_notification WHERE ID=?";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("i",$id);
            $stmt->execute();
            $query = $stmt->get_result();
            if($query){
                while($row=$query->fetch_assoc()){
                    $this->setId($row['ID']);
                    $this->setDateOfReceipt($row['Date_Of_Receipt']);
                    $this->setBuyerId($row['Buyer_ID']);
                    $this->setSellerId($row['Seller_ID']);
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
function getAllRecords($userId=null){
    $records = [];//empty array of records
        try{
            $sql="SELECT * FROM receipt_notification WHERE 1";
            if($userId!=null){
               $sql.=" AND Buyer_ID =?";
            }
            $stmt=Database::getConnection()->prepare($sql);
            if($userId!=null){
              $stmt->bind_param("i",$userId);
            }
            $stmt->execute();
            $query = $stmt->get_result();
            if($query){
                while($row=$query->fetch_assoc()){
                    $mReceiptNotification= new ReceiptNotification;
                    $mReceiptNotification->setId($row['ID']);
                    $mReceiptNotification->setDateOfReceipt($row['Date_Of_Receipt']);
                    $mReceiptNotification->setBuyerId($row['Buyer_ID']);
                    $mReceiptNotification->setSellerId($row['Seller_ID']);
                    $mReceiptNotification->setLocation($row['Location']);
                    $records[]=$mReceiptNotification;
                }//end while
            }//end query check
          }catch(Exception $exception){
            throw $exception;
          }//end catch
        return $records;
    }//end getAllRecords function

//function to create or edit instance of receiptNotification
function saveReceiptNotification($id,$dateOfReceipt,$buyerId,$sellerId,$location){
    try{
        //if id is null then we are saving a new record
        if((int)$id==0){
            $sql="INSERT INTO `receipt_notification`(`ID`,`Date_Of_Receipt`,`Buyer_ID`,`Seller_ID`,`Location`) VALUES(?,?,?,?,?)";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("isiis",$id,$dateOfReceipt,$buyerId,$sellerId,$location);
        }else{
            $sql="UPDATE `receipt_notification` SET `Date_Of_Receipt`=?,`Buyer_ID`=?,`Seller_ID`=?,`Location`=? WHERE ID=?";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("siisi",$dateOfReceipt,$buyerId,$sellerId,$location,$id);
        }//end id null check
        $stmt->execute();
        $stmt->store_result();
        $id = $stmt->insert_id==null?$id:$stmt->insert_id;
        $stmt->close();
        return new ReceiptNotification($id); 
    }catch(Exception $exception){
        throw $exception;
    }
}//end save function


    function getId(){
          return $this->id;
      }

    function getDateOfReceipt(){
          return $this->dateOfReceipt;
      }

    function getBuyerId(){
          return $this->buyerId;
      }

    function getBuyer(){
          return new User($this->buyerId);
      }

    function getSellerId(){
          return $this->sellerId;
      }

    function getSeller(){
          return new User($this->sellerId);
      }

    function getLocation(){
          return $this->location;
      }


    function setId($id){
          $this->id=$id;
      }


    function setDateOfReceipt($dateOfReceipt){
          $this->dateOfReceipt=$dateOfReceipt;
      }


    function setBuyerId($buyerId){
          $this->buyerId=$buyerId;
      }


    function setSellerId($sellerId){
          $this->sellerId=$sellerId;
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
        $names[]=$this->buyerId; 
        return implode(" ",$names);
    }




}//end class
