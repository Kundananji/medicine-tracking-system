<?php
class UserType{
  private $id;
  private $name ;
  private $description;
  private $canAddMedicine;
  private $canViewMedicine;
  private $canSale;
  private $canBuy;
  private $canReceive;
  private $canDeliver;
  private $canDispense;

//Constructor function, creates a new instance of userType; 
function __construct($id=null){
    if($id!=null){
        try{
            $sql="SELECT * FROM user_type WHERE ID=?";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("i",$id);
            $stmt->execute();
            $query = $stmt->get_result();
            if($query){
                while($row=$query->fetch_assoc()){
                    $this->setId($row['ID']);
                    $this->setName ($row['Name']);
                    $this->setDescription($row['Description']);
                    $this->setCanAddMedicine($row['Can_Add_Medicine']);
                    $this->setCanViewMedicine($row['Can_View_Medicine']);
                    $this->setCanSale($row['Can_Sale']);
                    $this->setCanBuy($row['Can_Buy']);
                    $this->setCanReceive($row['Can_Receive']);
                    $this->setCanDeliver($row['Can_Deliver']);
                    $this->setCanDispense($row['Can_Dispense']);
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
            $sql="SELECT * FROM user_type WHERE 1";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->execute();
            $query = $stmt->get_result();
            if($query){
                while($row=$query->fetch_assoc()){
                    $mUserType= new UserType;
                    $mUserType->setId($row['ID']);
                    $mUserType->setName ($row['Name']);
                    $mUserType->setDescription($row['Description']);
                    $mUserType->setCanAddMedicine($row['Can_Add_Medicine']);
                    $mUserType->setCanViewMedicine($row['Can_View_Medicine']);
                    $mUserType->setCanSale($row['Can_Sale']);
                    $mUserType->setCanBuy($row['Can_Buy']);
                    $mUserType->setCanReceive($row['Can_Receive']);
                    $mUserType->setCanDeliver($row['Can_Deliver']);
                    $mUserType->setCanDispense($row['Can_Dispense']);
                    $records[]=$mUserType;
                }//end while
            }//end query check
          }catch(Exception $exception){
            throw $exception;
          }//end catch
        return $records;
    }//end getAllRecords function

//function to create or edit instance of userType
function saveUserType($id,$name ,$description,$canAddMedicine,$canViewMedicine,$canSale,$canBuy,$canReceive,$canDeliver,$canDispense,$canAddMedicine){
    try{
        //if id is null then we are saving a new record
        if((int)$id==0){
            $sql="INSERT INTO `user_type`(`ID`,`Name`,`Description`,`Can_Add_Medicine`,`Can_View_Medicine`,`Can_Sale`,`Can_Buy`,`Can_Receive`,`Can_Deliver`,`Can_Dispense`) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("issiiiiiiii",$id,$name ,$description,$canAddMedicine,$canViewMedicine,$canSale,$canBuy,$canReceive,$canDeliver,$canDispense,$canAddMedicine);
        }else{
            $sql="UPDATE `user_type` SET `Name`=?,`Description`=?,`Can_Add_Medicine`=?,`Can_View_Medicine`=?,`Can_Sale`=?,`Can_Buy`=?,`Can_Receive`=?,`Can_Deliver`=?,`Can_Dispense`=?,`Can_Add_Medicine`=? WHERE ID=?";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("ssiiiiiiiii",$name ,$description,$canAddMedicine,$canViewMedicine,$canSale,$canBuy,$canReceive,$canDeliver,$canDispense,$canAddMedicine,$id);
        }//end id null check
        $stmt->execute();
        $stmt->store_result();
        $id = $stmt->insert_id==null?$id:$stmt->insert_id;
        $stmt->close();
        return new UserType($id); 
    }catch(Exception $exception){
        throw $exception;
    }
}//end save function


    function getId(){
          return $this->id;
      }

    function getName (){
          return $this->name ;
      }

    function getDescription(){
          return $this->description;
      }

    function getCanAddMedicine(){
          return $this->canAddMedicine;
      }

    function getCanViewMedicine(){
          return $this->canViewMedicine;
      }

    function getCanSale(){
          return $this->canSale;
      }

    function getCanBuy(){
          return $this->canBuy;
      }

    function getCanReceive(){
          return $this->canReceive;
      }

    function getCanDeliver(){
          return $this->canDeliver;
      }

    function getCanDispense(){
          return $this->canDispense;
      }


    function setId($id){
          $this->id=$id;
      }


    function setName ($name ){
          $this->name =$name ;
      }


    function setDescription($description){
          $this->description=$description;
      }


    function setCanAddMedicine($canAddMedicine){
          $this->canAddMedicine=$canAddMedicine;
      }


    function setCanViewMedicine($canViewMedicine){
          $this->canViewMedicine=$canViewMedicine;
      }


    function setCanSale($canSale){
          $this->canSale=$canSale;
      }


    function setCanBuy($canBuy){
          $this->canBuy=$canBuy;
      }


    function setCanReceive($canReceive){
          $this->canReceive=$canReceive;
      }


    function setCanDeliver($canDeliver){
          $this->canDeliver=$canDeliver;
      }


    function setCanDispense($canDispense){
          $this->canDispense=$canDispense;
      }


      /**
      * Function to give a name to an object
      * @return string : name of object
      **/
    function __toString(){
        $names = [];   
        $names[]=$this->name; 
        return implode(" ",$names);
    }




}//end class
