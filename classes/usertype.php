<?php
class UserType{
  private $id;
  private $name ;
  private $description;
  private $canAddMedicine;
  private $canViewMedicine;
  private $canSale;
  private $canReceive;
  private $canDeliver;
  private $canDispense;
  private $canMine;
  private $canReportDamage;
  private $canViewReport;

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
                    $this->setCanReceive($row['Can_Receive']);
                    $this->setCanDeliver($row['Can_Deliver']);
                    $this->setCanDispense($row['Can_Dispense']);
                    $this->setCanMine($row['Can_Mine']);
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
                    $mUserType->setCanReceive($row['Can_Receive']);
                    $mUserType->setCanDeliver($row['Can_Deliver']);
                    $mUserType->setCanDispense($row['Can_Dispense']);
                    $mUserType->setCanMine($row['Can_Mine']);
                    $records[]=$mUserType;
                }//end while
            }//end query check
          }catch(Exception $exception){
            throw $exception;
          }//end catch
        return $records;
    }//end getAllRecords function

//function to create or edit instance of userType
function saveUserType($id,$name ,$description,$canAddMedicine,$canViewMedicine,$canSale,$canReceive,$canDeliver,$canDispense,$canMine){
    try{
        //if id is null then we are saving a new record
        if((int)$id==0){
            $sql="INSERT INTO `user_type`(`ID`,`Name`,`Description`,`Can_Add_Medicine`,`Can_View_Medicine`,`Can_Sale`,`Can_Receive`,`Can_Deliver`,`Can_Dispense`,`Can_Mine`) VALUES(?,?,?,?,?,?,?,?,?,?)";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("issiiiiiii",$id,$name ,$description,$canAddMedicine,$canViewMedicine,$canSale,$canReceive,$canDeliver,$canDispense,$canMine);
        }else{
            $sql="UPDATE `user_type` SET `Name`=?,`Description`=?,`Can_Add_Medicine`=?,`Can_View_Medicine`=?,`Can_Sale`=?,`Can_Receive`=?,`Can_Deliver`=?,`Can_Dispense`=?,`Can_Mine`=? WHERE ID=?";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("ssiiiiiiii",$name ,$description,$canAddMedicine,$canViewMedicine,$canSale,$canReceive,$canDeliver,$canDispense,$canMine,$id);
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

    function getCanReceive(){
          return $this->canReceive;
      }

    function getCanDeliver(){
          return $this->canDeliver;
      }

    function getCanDispense(){
          return $this->canDispense;
      }

    function getCanMine(){
          return $this->canMine;
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


    function setCanReceive($canReceive){
          $this->canReceive=$canReceive;
      }


    function setCanDeliver($canDeliver){
          $this->canDeliver=$canDeliver;
      }


    function setCanDispense($canDispense){
          $this->canDispense=$canDispense;
      }


    function setCanMine($canMine){
          $this->canMine=$canMine;
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





  /**
   * Get the value of canReportDamage
   */ 
  public function getCanReportDamage()
  {
    return $this->canReportDamage;
  }

  /**
   * Set the value of canReportDamage
   *
   * @return  self
   */ 
  public function setCanReportDamage($canReportDamage)
  {
    $this->canReportDamage = $canReportDamage;

    return $this;
  }

  /**
   * Get the value of canViewReport
   */ 
  public function getCanViewReport()
  {
    return $this->canViewReport;
  }

  /**
   * Set the value of canViewReport
   *
   * @return  self
   */ 
  public function setCanViewReport($canViewReport)
  {
    $this->canViewReport = $canViewReport;

    return $this;
  }
}//end class
