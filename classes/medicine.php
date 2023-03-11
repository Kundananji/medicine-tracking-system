<?php
class Medicine implements \JsonSerializable
{
  private $id;
  private $name;
  private $description;
  private $manufacturedDate;
  private $expiryDate;
  private $gtin;
  private $serialNumber;
  private $lotNumber;
  private $packageDetails;
  private $manufacturerId;
  private $manufacturer;

  //Constructor function, creates a new instance of medicine; 
  function __construct($id = null)
  {
    if ($id != null) {
      try {
        $sql = "SELECT * FROM medicine WHERE ID=?";
        $stmt = Database::getConnection()->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $query = $stmt->get_result();
        if ($query) {
          while ($row = $query->fetch_assoc()) {
            $this->setId($row['ID']);
            $this->setName($row['Name']);
            $this->setDescription($row['Description']);
            $this->setManufacturedDate($row['Manufactured_Date']);
            $this->setExpiryDate($row['Expiry_Date']);
            $this->setGtin($row['GTIN']);
            $this->setSerialNumber($row['Serial_Number']);
            $this->setLotNumber($row['LOT_Number']);
            $this->setPackageDetails($row['Package_Details']);
            $this->setManufacturerId($row['Manufacturer_ID']);
            $this->setManufacturer($row['Manufacturer_ID']);
          } //end while
        } //end query check
      } catch (Exception $exception) {
        throw $exception;
      } //end catch
    } //end id check
  } //end constructor



  /**
   * Function to fetch all records 
   * @return array of fetched records 
   * Function to fetch all records 
   **/
  function search($searchText)
  {
    $records = []; //empty array of records
    try {
      $sql = "SELECT * FROM medicine WHERE Name LIKE '%$searchText%' OR LOT_Number='$searchText' OR Serial_Number='$searchText' OR GTIN='$searchText' ";
      $stmt = Database::getConnection()->prepare($sql);
      $stmt->execute();
      $query = $stmt->get_result();
      if ($query) {
        while ($row = $query->fetch_assoc()) {
          $mMedicine = new Medicine;
          $mMedicine->setId($row['ID']);
          $mMedicine->setName($row['Name']);
          $mMedicine->setDescription($row['Description']);
          $mMedicine->setManufacturedDate($row['Manufactured_Date']);
          $mMedicine->setExpiryDate($row['Expiry_Date']);
          $mMedicine->setGtin($row['GTIN']);
          $mMedicine->setSerialNumber($row['Serial_Number']);
          $mMedicine->setLotNumber($row['LOT_Number']);
          $mMedicine->setPackageDetails($row['Package_Details']);
          $mMedicine->setManufacturerId($row['Manufacturer_ID']);
          $mMedicine->setManufacturer($row['Manufacturer_ID']);
     
          $records[] = $mMedicine;
        } //end while
      } //end query check
    } catch (Exception $exception) {
      throw $exception;
    } //end catch
    return $records;
  } //end getAllRecords function



  /**
   * Function to fetch all records 
   * @return array of fetched records 
   * Function to fetch all records 
   **/
  function getAllRecords()
  {
    $records = []; //empty array of records
    try {
      $sql = "SELECT * FROM medicine WHERE 1";
      $stmt = Database::getConnection()->prepare($sql);
      $stmt->execute();
      $query = $stmt->get_result();
      if ($query) {
        while ($row = $query->fetch_assoc()) {
          $mMedicine = new Medicine;
          $mMedicine->setId($row['ID']);
          $mMedicine->setName($row['Name']);
          $mMedicine->setDescription($row['Description']);
          $mMedicine->setManufacturedDate($row['Manufactured_Date']);
          $mMedicine->setExpiryDate($row['Expiry_Date']);
          $mMedicine->setGtin($row['GTIN']);
          $mMedicine->setSerialNumber($row['Serial_Number']);
          $mMedicine->setLotNumber($row['LOT_Number']);
          $mMedicine->setPackageDetails($row['Package_Details']);
          $mMedicine->setManufacturerId($row['Manufacturer_ID']);
          $mMedicine->setManufacturer($row['Manufacturer_ID']);
          $records[] = $mMedicine;
        } //end while
      } //end query check
    } catch (Exception $exception) {
      throw $exception;
    } //end catch
    return $records;
  } //end getAllRecords function

  //function to create or edit instance of medicine
  function saveMedicine($id, $name, $description, $manufacturedDate, $expiryDate, $gtin, $serialNumber, $lotNumber, $packageDetails, $manufacturerId)
  {
    try {
      //if id is null then we are saving a new record
      if ((int)$id == 0) {
        $sql = "INSERT INTO `medicine`(`ID`,`Name`,`Description`,`Manufactured_Date`,`Expiry_Date`,`GTIN`,`Serial_Number`,`LOT_Number`,`Package_Details`,`Manufacturer_ID`) VALUES(?,?,?,?,?,?,?,?,?,?)";
        $stmt = Database::getConnection()->prepare($sql);
        $stmt->bind_param("issssssssi", $id, $name, $description, $manufacturedDate, $expiryDate, $gtin, $serialNumber, $lotNumber, $packageDetails, $manufacturerId);
      } else {
        $sql = "UPDATE `medicine` SET `Name`=?,`Description`=?,`Manufactured_Date`=?,`Expiry_Date`=?,`GTIN`=?,`Serial_Number`=?,`LOT_Number`=?,`Package_Details`=?,`Manufacturer_ID`=? WHERE ID=?";
        $stmt = Database::getConnection()->prepare($sql);
        $stmt->bind_param("ssssssssii", $name, $description, $manufacturedDate, $expiryDate, $gtin, $serialNumber, $lotNumber, $packageDetails, $manufacturerId, $id);
      } //end id null check
      $stmt->execute();
      $stmt->store_result();
      $id = $stmt->insert_id == null ? $id : $stmt->insert_id;
      $stmt->close();
      return new Medicine($id);
    } catch (Exception $exception) {
      throw $exception;
    }
  } //end save function


  function getId()
  {
    return $this->id;
  }

  function getName()
  {
    return $this->name;
  }

  function getDescription()
  {
    return $this->description;
  }

  function getManufacturedDate()
  {
    return $this->manufacturedDate;
  }

  function getExpiryDate()
  {
    return $this->expiryDate;
  }

  function getGtin()
  {
    return $this->gtin;
  }

  function getSerialNumber()
  {
    return $this->serialNumber;
  }

  function getLotNumber()
  {
    return $this->lotNumber;
  }

  function getPackageDetails()
  {
    return $this->packageDetails;
  }

  function getManufacturerId()
  {
    return $this->manufacturerId;
  }

  function getManufacturer()
  {
    return $this->manufacturer;
  }

  /**
   * Set the value of manufacturer
   *
   */
  public function setManufacturer($manufacturerId)
  {
    $this->manufacturer = new User($manufacturerId);
  }



  function setId($id)
  {
    $this->id = $id;
  }


  function setName($name)
  {
    $this->name = $name;
  }


  function setDescription($description)
  {
    $this->description = $description;
  }


  function setManufacturedDate($manufacturedDate)
  {
    $this->manufacturedDate = $manufacturedDate;
  }


  function setExpiryDate($expiryDate)
  {
    $this->expiryDate = $expiryDate;
  }


  function setGtin($gtin)
  {
    $this->gtin = $gtin;
  }


  function setSerialNumber($serialNumber)
  {
    $this->serialNumber = $serialNumber;
  }


  function setLotNumber($lotNumber)
  {
    $this->lotNumber = $lotNumber;
  }


  function setPackageDetails($packageDetails)
  {
    $this->packageDetails = $packageDetails;
  }


  function setManufacturerId($manufacturerId)
  {
    $this->manufacturerId = $manufacturerId;
  }


  /**
   * Function to give a name to an object
   * @return string : name of object
   **/
  function __toString()
  {
    $names = [];
    $names[] = $this->name;
    return implode(" ", $names);
  }


  public function jsonSerialize()
  {
    return get_object_vars($this);
  }
}//end class
