<?php
class DamageNotificationMedicine
{
  private $id;
  private $damageNotificationId;
  private $medicineId;
  private $quantity;
  private $details;

  //Constructor function, creates a new instance of damageNotificationMedicine; 
  function __construct($id = null)
  {
    if ($id != null) {
      try {
        $sql = "SELECT * FROM damage_notification_medicine WHERE ID=?";
        $stmt = Database::getConnection()->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $query = $stmt->get_result();
        if ($query) {
          while ($row = $query->fetch_assoc()) {
            $this->setId($row['ID']);
            $this->setDamageNotificationId($row['Damage_Notification_ID']);
            $this->setMedicineId($row['Medicine_ID']);
            $this->setQuantity($row['Quantity']);
            $this->setDetails($row['Details']);
          } //end while
        } //end query check
      } catch (Exception $exception) {
        throw $exception;
      } //end catch
    } //end id check
  } //end constructor

  /**
   * Function to fetch all records 
   * 
   * @return array of fetched records 
   * 
   **/
  function getRecordsByDamageNotificationId($damageNotificationId)
  {
    $records = []; //empty array of records
    try {
      $sql = "SELECT * FROM damage_notification_medicine WHERE Damage_Notification_ID=?";
      $stmt = Database::getConnection()->prepare($sql);
      $stmt->bind_param("i", $damageNotificationId);
      $stmt->execute();
      $query = $stmt->get_result();
      if ($query) {
        while ($row = $query->fetch_assoc()) {
          $records[] = new DamageNotificationMedicine($row['ID']);
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
      $sql = "SELECT * FROM damage_notification_medicine WHERE 1";
      $stmt = Database::getConnection()->prepare($sql);
      $stmt->execute();
      $query = $stmt->get_result();
      if ($query) {
        while ($row = $query->fetch_assoc()) {
          $records[] = new DamageNotificationMedicine($row['ID']);
        } //end while
      } //end query check
    } catch (Exception $exception) {
      throw $exception;
    } //end catch
    return $records;
  } //end getAllRecords function

  //function to create or edit instance of damageNotificationMedicine
  function saveDamageNotificationMedicine($id, $damageNotificationId, $medicineId, $quantity, $details)
  {
    try {
      //if id is null then we are saving a new record
      if ((int)$id == 0) {
        $sql = "INSERT INTO `damage_notification_medicine`(`ID`,`Damage_Notification_ID`,`Medicine_ID`,`Quantity`,`Details`) VALUES(?,?,?,?,?)";
        $stmt = Database::getConnection()->prepare($sql);
        $stmt->bind_param("iiiis", $id, $damageNotificationId, $medicineId, $quantity, $details);
      } else {
        $sql = "UPDATE `damage_notification_medicine` SET `Damage_Notification_ID`=?,`Medicine_ID`=?,`Quantity`=?,`Details`=? WHERE ID=?";
        $stmt = Database::getConnection()->prepare($sql);
        $stmt->bind_param("iiisi", $damageNotificationId, $medicineId, $quantity, $details, $id);
      } //end id null check
      $stmt->execute();
      $stmt->store_result();
      $id = $stmt->insert_id == null ? $id : $stmt->insert_id;
      $stmt->close();
      return new DamageNotificationMedicine($id);
    } catch (Exception $exception) {
      throw $exception;
    }
  } //end save function


  function getId()
  {
    return $this->id;
  }

  function getDamageNotificationId()
  {
    return $this->damageNotificationId;
  }

  function getDamageNotification()
  {
    return new DamageNotification($this->damageNotificationId);
  }

  function getMedicineId()
  {
    return $this->medicineId;
  }

  function getMedicine()
  {
    return new Medicine($this->medicineId);
  }

  function getQuantity()
  {
    return $this->quantity;
  }



  function getDetails()
  {
    return $this->details;
  }


  function setId($id)
  {
    $this->id = $id;
  }


  function setDamageNotificationId($damageNotificationId)
  {
    $this->damageNotificationId = $damageNotificationId;
  }


  function setMedicineId($medicineId)
  {
    $this->medicineId = $medicineId;
  }


  function setQuantity($quantity)
  {
    $this->quantity = $quantity;
  }


  function setDetails($details)
  {
    $this->details = $details;
  }


  /**
   * Function to give a name to an object
   * @return string : name of object
   **/
  function __toString()
  {
    $names = [];
    $names[] = $this->details;
    return implode(" ", $names);
  }
}//end class
