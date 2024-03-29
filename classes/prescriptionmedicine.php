<?php
class PrescriptionMedicine{
  private $id;
  private $prescriptionId;
  private $medicineId;
  private $quantity;
  private $dosage;

//Constructor function, creates a new instance of prescriptionMedicine; 
function __construct($id=null){
    if($id!=null){
        try{
            $sql="SELECT * FROM prescription_medicine WHERE ID=?";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("i",$id);
            $stmt->execute();
            $query = $stmt->get_result();
            if($query){
                while($row=$query->fetch_assoc()){
                    $this->setId($row['ID']);
                    $this->setPrescriptionId($row['Prescription_ID']);
                    $this->setMedicineId($row['Medicine_ID']);
                    $this->setQuantity($row['Quantity']);
                    $this->setDosage($row['Dosage']);
                }//end while
            }//end query check
          }catch(Exception $exception){
            throw $exception;
          }//end catch
        }//end id check
    }//end constructor

/**
* Function to records provided a particular prescription Id 
* @return array of fetched records 
*  
**/
function getRecordsByPrescriptionId($prescriptionId){
  $records = [];//empty array of records
      try{
          $sql="SELECT * FROM prescription_medicine WHERE Prescription_ID=?";
          $stmt=Database::getConnection()->prepare($sql);
          $stmt->bind_param("i",$prescriptionId);
          $stmt->execute();
          $query = $stmt->get_result();
          if($query){
              while($row=$query->fetch_assoc()){
                $records[]= new PrescriptionMedicine($row['ID']);
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
            $sql="SELECT * FROM prescription_medicine WHERE 1";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->execute();
            $query = $stmt->get_result();
            if($query){
                while($row=$query->fetch_assoc()){
                  $records[]= new PrescriptionMedicine($row['ID']);
                }//end while
            }//end query check
          }catch(Exception $exception){
            throw $exception;
          }//end catch
        return $records;
    }//end getAllRecords function

//function to create or edit instance of prescriptionMedicine
function savePrescriptionMedicine($id,$prescriptionId,$medicineId,$quantity,$dosage){
    try{
        //if id is null then we are saving a new record
        if((int)$id==0){
            $sql="INSERT INTO `prescription_medicine`(`ID`,`Prescription_ID`,`Medicine_ID`,`Quantity`,`Dosage`) VALUES(?,?,?,?,?)";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("iiiis",$id,$prescriptionId,$medicineId,$quantity,$dosage);
        }else{
            $sql="UPDATE `prescription_medicine` SET `Prescription_ID`=?,`Medicine_ID`=?,`Quantity`=?,`Dosage`=? WHERE ID=?";
            $stmt=Database::getConnection()->prepare($sql);
            $stmt->bind_param("iiisi",$prescriptionId,$medicineId,$quantity,$dosage,$id);
        }//end id null check
        $stmt->execute();
        $stmt->store_result();
        $id = $stmt->insert_id==null?$id:$stmt->insert_id;
        $stmt->close();
        return new PrescriptionMedicine($id); 
    }catch(Exception $exception){
        throw $exception;
    }
}//end save function


    function getId(){
          return $this->id;
      }

    function getPrescriptionId(){
          return $this->prescriptionId;
      }

    function getPrescription(){
          return new Prescription($this->prescriptionId);
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



    function getDosage(){
          return $this->dosage;
      }


    function setId($id){
          $this->id=$id;
      }


    function setPrescriptionId($prescriptionId){
          $this->prescriptionId=$prescriptionId;
      }


    function setMedicineId($medicineId){
          $this->medicineId=$medicineId;
      }


    function setQuantity($quantity){
          $this->quantity=$quantity;
      }





    function setDosage($dosage){
          $this->dosage=$dosage;
      }


      /**
      * Function to give a name to an object
      * @return string : name of object
      **/
    function __toString(){
        $names = [];   
        $names[]=$this->dosage; 
        return implode(" ",$names);
    }




}//end class
