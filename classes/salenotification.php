<?php
class SaleNotification{
  private $id;
  private $dateOfSale;
  private $buyerId;
  private $sellerId;
  private $location;

//Constructor function, creates a new instance of saleNotification; 
function __construct($id=null){
    if($id!=null){
        try{
            $sql="SELECT * FROM sale_notification WHERE ID=?";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("i",$id);
            $stmt->execute();
            $query = $stmt->get_result();
            if($query){
                while($row=$query->fetch_assoc()){
                    $this->setId($row['ID']);
                    $this->setDateOfSale($row['Date_Of_Sale']);
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
* 
**/
function getAllRecordsByUserId($userId){
  $records = [];//empty array of records
      try{
          $sql="SELECT * FROM sale_notification WHERE 1 AND Seller_ID=? ";
          $stmt=Database::getConnection()->prepare($sql);
          $stmt->bind_param("i",$userId);
          $stmt->execute();
          $query = $stmt->get_result();
          if($query){
              while($row=$query->fetch_assoc()){
                  $mSaleNotification= new SaleNotification;
                  $mSaleNotification->setId($row['ID']);
                  $mSaleNotification->setDateOfSale($row['Date_Of_Sale']);
                  $mSaleNotification->setBuyerId($row['Buyer_ID']);
                  $mSaleNotification->setSellerId($row['Seller_ID']);
                  $mSaleNotification->setLocation($row['Location']);
                  $records[]=$mSaleNotification;
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
* 
**/
function getAllRecords(){
    $records = [];//empty array of records
        try{
            $sql="SELECT * FROM sale_notification WHERE 1";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->execute();
            $query = $stmt->get_result();
            if($query){
                while($row=$query->fetch_assoc()){
                    $mSaleNotification= new SaleNotification;
                    $mSaleNotification->setId($row['ID']);
                    $mSaleNotification->setDateOfSale($row['Date_Of_Sale']);
                    $mSaleNotification->setBuyerId($row['Buyer_ID']);
                    $mSaleNotification->setSellerId($row['Seller_ID']);
                    $mSaleNotification->setLocation($row['Location']);
                    $records[]=$mSaleNotification;
                }//end while
            }//end query check
          }catch(Exception $exception){
            throw $exception;
          }//end catch
        return $records;
    }//end getAllRecords function

//function to create or edit instance of saleNotification
function saveSaleNotification($id,$dateOfSale,$buyerId,$sellerId,$location){
    try{
        //if id is null then we are saving a new record
        if((int)$id==0){
            $sql="INSERT INTO `sale_notification`(`ID`,`Date_Of_Sale`,`Buyer_ID`,`Seller_ID`,`Location`) VALUES(?,?,?,?,?)";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("isiis",$id,$dateOfSale,$buyerId,$sellerId,$location);
        }else{
            $sql="UPDATE `sale_notification` SET `Date_Of_Sale`=?,`Buyer_ID`=?,`Seller_ID`=?,`Location`=? WHERE ID=?";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("siisi",$dateOfSale,$buyerId,$sellerId,$location,$id);
        }//end id null check
        $stmt->execute();
        $stmt->store_result();
        $id = $stmt->insert_id==null?$id:$stmt->insert_id;
        $stmt->close();
        return new SaleNotification($id); 
    }catch(Exception $exception){
        throw $exception;
    }
}//end save function


    function getId(){
          return $this->id;
      }

    function getDateOfSale(){
          return $this->dateOfSale;
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


    function setDateOfSale($dateOfSale){
          $this->dateOfSale=$dateOfSale;
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
