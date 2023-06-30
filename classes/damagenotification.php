<?php
class DamageNotification{
  private $id;
  private $dateOfNotification;
  private $reportedbyId;
  private $details;
  private $location;

//Constructor function, creates a new instance of damageNotification; 
function __construct($id=null){
    if($id!=null){
        try{
            $sql="SELECT * FROM damage_notification WHERE ID=?";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("i",$id);
            $stmt->execute();
            $query = $stmt->get_result();
            if($query){
                while($row=$query->fetch_assoc()){
                    $this->setId($row['ID']);
                    $this->setDateOfNotification($row['Date_Of_Notification']);
                    $this->setReportedbyId($row['Reported_By_ID']);
                    $this->setDetails($row['Details']);
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
function getAllRecords($userId = null){
    $records = [];//empty array of records
        try{
            $sql="SELECT * FROM damage_notification WHERE 1";
            if($userId !=null){
                $sql.=" AND Reported_By_ID=? ";
            }
            $stmt=Database::getConnection()->prepare($sql);
            if($userId !=null){
                $stmt->bind_param("i",$userId);
            }
            $stmt->execute();
            $query = $stmt->get_result();
            if($query){
                while($row=$query->fetch_assoc()){
                    $mDamageNotification= new DamageNotification;
                    $mDamageNotification->setId($row['ID']);
                    $mDamageNotification->setDateOfNotification($row['Date_Of_Notification']);
                    $mDamageNotification->setReportedbyId($row['Reported_By_ID']);
                    $mDamageNotification->setDetails($row['Details']);
                    $mDamageNotification->setLocation($row['Location']);
                    $records[]=$mDamageNotification;
                }//end while
            }//end query check
          }catch(Exception $exception){
            throw $exception;
          }//end catch
        return $records;
    }//end getAllRecords function

//function to create or edit instance of damageNotification
function saveDamageNotification($id,$dateOfNotification,$reportedbyId,$details,$location){
    try{
        //if id is null then we are saving a new record
        if((int)$id==0){
            $sql="INSERT INTO `damage_notification`(`ID`,`Date_Of_Notification`,`Reported_By_ID`,`Details`,`Location`) VALUES(?,?,?,?,?)";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("isiss",$id,$dateOfNotification,$reportedbyId,$details,$location);
        }else{
            $sql="UPDATE `damage_notification` SET `Date_Of_Notification`=?,`Reported_By_ID`=?,`Details`=?,`Location`=? WHERE ID=?";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("sissi",$dateOfNotification,$reportedbyId,$details,$location,$id);
        }//end id null check
        $stmt->execute();
        $stmt->store_result();
        $id = $stmt->insert_id==null?$id:$stmt->insert_id;
        $stmt->close();
        return new DamageNotification($id); 
    }catch(Exception $exception){
        throw $exception;
    }
}//end save function


    function getId(){
          return $this->id;
      }

    function getDateOfNotification(){
          return $this->dateOfNotification;
      }

    function getReportedbyId(){
          return $this->reportedbyId;
      }

    function getReporter(){
          return new User($this->reportedbyId);
      }

    function getDetails(){
          return $this->details;
      }

    function getLocation(){
          return $this->location;
      }


    function setId($id){
          $this->id=$id;
      }


    function setDateOfNotification($dateOfNotification){
          $this->dateOfNotification=$dateOfNotification;
      }


    function setReportedbyId($reportedbyId){
          $this->reportedbyId=$reportedbyId;
      }


    function setDetails($details){
          $this->details=$details;
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
        $names[]=$this->details; 
        return implode(" ",$names);
    }




}//end class
