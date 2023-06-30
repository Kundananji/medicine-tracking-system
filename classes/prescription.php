<?php
class Prescription{
  private $id;
  private $prescriptionDate;
  private $hospitalId;
  private $patientId;
  private $location;

//Constructor function, creates a new instance of prescription; 
function __construct($id=null){
    if($id!=null){
        try{
            $sql="SELECT * FROM prescription WHERE ID=?";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("i",$id);
            $stmt->execute();
            $query = $stmt->get_result();
            if($query){
                while($row=$query->fetch_assoc()){
                    $this->setId($row['ID']);
                    $this->setPrescriptionDate($row['Prescription_Date']);
                    $this->setHospitalId($row['Hospital_ID']);
                    $this->setPatientId($row['Patient_ID']);
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
            $sql="SELECT * FROM prescription WHERE 1";
            if($userId!=null){
              $sql.=" AND Hospital_ID=?";
            }
            $stmt=Database::getConnection()->prepare($sql);
            if($userId!=null){
              $stmt->bind_param("i",$userId);
            }
            $stmt->execute();
            $query = $stmt->get_result();
            if($query){
                while($row=$query->fetch_assoc()){
                    $mPrescription= new Prescription;
                    $mPrescription->setId($row['ID']);
                    $mPrescription->setPrescriptionDate($row['Prescription_Date']);
                    $mPrescription->setHospitalId($row['Hospital_ID']);
                    $mPrescription->setPatientId($row['Patient_ID']);
                    $mPrescription->setLocation($row['Location']);
                    $records[]=$mPrescription;
                }//end while
            }//end query check
          }catch(Exception $exception){
            throw $exception;
          }//end catch
        return $records;
    }//end getAllRecords function

//function to create or edit instance of prescription
function savePrescription($id,$prescriptionDate,$hospitalId,$patientId,$location){
    try{
        //if id is null then we are saving a new record
        if((int)$id==0){
            $sql="INSERT INTO `prescription`(`ID`,`Prescription_Date`,`Hospital_ID`,`Patient_ID`,`Location`) VALUES(?,?,?,?,?)";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("isiis",$id,$prescriptionDate,$hospitalId,$patientId,$location);
        }else{
            $sql="UPDATE `prescription` SET `Prescription_Date`=?,`Hospital_ID`=?,`Patient_ID`=?,`Location`=? WHERE ID=?";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("siisi",$prescriptionDate,$hospitalId,$patientId,$location,$id);
        }//end id null check
        $stmt->execute();
        $stmt->store_result();
        $id = $stmt->insert_id==null?$id:$stmt->insert_id;
        $stmt->close();
        return new Prescription($id); 
    }catch(Exception $exception){
        throw $exception;
    }
}//end save function


    function getId(){
          return $this->id;
      }

    function getPrescriptionDate(){
          return $this->prescriptionDate;
      }

    function getHospitalId(){
          return $this->hospitalId;
      }

    function getHospital(){
          return new User($this->hospitalId);
      }

    function getPatientId(){
          return $this->patientId;
      }

    function getPatient(){
          return new User($this->patientId);
      }


    function setId($id){
          $this->id=$id;
      }


    function setPrescriptionDate($prescriptionDate){
          $this->prescriptionDate=$prescriptionDate;
      }


    function setHospitalId($hospitalId){
          $this->hospitalId=$hospitalId;
      }


    function setPatientId($patientId){
          $this->patientId=$patientId;
      }


      /**
      * Function to give a name to an object
      * @return string : name of object
      **/
    function __toString(){
        $names = [];   
        $names[]=$this->patientId; 
        return implode(" ",$names);
    }





  /**
   * Get the value of location
   */ 
  public function getLocation()
  {
    return $this->location;
  }

  /**
   * Set the value of location
   *
   * @return  self
   */ 
  public function setLocation($location)
  {
    $this->location = $location;

    return $this;
  }
}//end class
