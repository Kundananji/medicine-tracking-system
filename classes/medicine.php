<?php 

class Medicine{
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


    /**
     * function to add medicine to database
     * 
     */
    function addMedicine($name,$description,$manufacturedDate,$expiryDate,$gtin,$serialNumber,$lotNumber,$packageDetails,$manufacturerId){
   
        //insert medicine    
        $sql ="INSERT INTO `medicine`( `Name`, `Description`, `Manufactured_Date`, `Expiry_Date`, `GTIN`, `Serial_Number`, `LOT_Number`, `Package_Details`, `Manufacturer_ID`) VALUES (?,?,?,?,?,?,?,?,?)";

         $stmt=Database::getConnection()->prepare($sql);
         $stmt->bind_param("ssssssssi",$name,$description,$manufacturedDate,$expiryDate,$gtin,$serialNumber,$lotNumber,$packageDetails,$manufacturerId);         
         if($stmt->execute()){
            $insertId = $stmt->insert_id;
            $this->setId($insertId);
            return $this->getMedicineById();
         }

        }

    /**
     * 
     * function to edit medicine
     * 
     *  */   
    
     function editMedicine($id,$name,$description,$manufacturedDate,$expiryDate,$gtin,$serialNumber,$lotNumber,$packageDetails,$manufacturerId) : Medicine{
        $sql ="UPDATE `medicine` SET `Name`=?,`Description`=?,`Manufactured_Date`=?,`Expiry_Date`=?,`GTIN`=?,`Serial_Number`=?,`LOT_Number`=?,`Package_Details`=?,`Manufacturer_ID`=? WHERE ID =?";

        $stmt=Database::getConnection()->prepare($sql);
        $stmt->bind_param("ssssssssii",$name,$description,$manufacturedDate,$expiryDate,$gtin,$serialNumber,$lotNumber,$packageDetails,$manufacturerId,$id);
        if($stmt->execute()){
            return $this->getMedicineById($id);
        }

        return null;

     }



    /**
     * 
     * Function to fetch medicine by Id
     * 
     * 
     */

    function getMedicineById() : Medicine{
        $sql ="SELECT `ID`, `Name`, `Description`, `Manufactured_Date`, `Expiry_Date`, `GTIN`, `Serial_Number`, `LOT_Number`, `Package_Details`, `Manufacturer_ID` FROM `medicine` WHERE `ID`=?";

        $stmt = Database::getConnection()->prepare($sql);
        $stmt->bind_param("i",$this->id);
        $result = $stmt->get_result();
        if($result){
            if($row = $result->fetch_assoc()){
                return $this->extractMedicine($row);
            }
        }

        return null;

    }

    /**
     * 
     * Function to get medicine by manufacturer Id
     */

    function getMedicineByManufacturer(){
        $medicines = [];
        $sql ="SELECT `ID`, `Name`, `Description`, `Manufactured_Date`, `Expiry_Date`, `GTIN`, `Serial_Number`, `LOT_Number`, `Package_Details`, `Manufacturer_ID` FROM `medicine` WHERE `Manufacturer_ID`=? ORDER BY `Name`";

        $stmt = Database::getConnection()->prepare($sql);
        $stmt->bind_param("i",$this->manufacturerId);
        $result = $stmt->get_result();
        if($result){
            while($row = $result->fetch_assoc()){
                $medicines[] = $this->extractMedicine($row);

            }
        }
        return $medicines;

    }

    /**
     * 
     * function to get all medicines
     */

     function getMedicines(){
        $medicines = [];
        $sql ="SELECT `ID`, `Name`, `Description`, `Manufactured_Date`, `Expiry_Date`, `GTIN`, `Serial_Number`, `LOT_Number`, `Package_Details`, `Manufacturer_ID` FROM `medicine` ORDER BY `Name`";

        $stmt = Database::getConnection()->prepare($sql);
        $result = $stmt->get_result();
        if($result){
            while($row = $result->fetch_assoc()){
                $medicines[] = $this->extractMedicine($row);

            }
        }
        return $medicines;

    }

    /**
     * 
     * function to extract medicine object from array of fields
     * @param row : array containing fields
     * @return medicine object
     */

     function extractMedicine($row) : Medicine{
        $mMedicine =new Medicine;

        $mMedicine->setId($row['']);
        $mMedicine->setName($row['Name']);
        $mMedicine->setDescription($row['Description']);
        $mMedicine->setManufacturedDate($row['Manufactured_Date']);
        $mMedicine->setExpiryDate($row['Expiry_Date']);
        $mMedicine->setGtin($row['GTIN']);
        $mMedicine->setSerialNumber($row['Serial_Number']);
        $mMedicine->setLotNumber($row['LOT_Number']);
        $mMedicine->setPackageDetails($row['Package_Details']);
        $mMedicine->setManufacturerId($row['Manufacturer_ID']);


        return  $mMedicine;

     }
    

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of manufacturedDate
     */ 
    public function getManufacturedDate()
    {
        return $this->manufacturedDate;
    }

    /**
     * Set the value of manufacturedDate
     *
     * @return  self
     */ 
    public function setManufacturedDate($manufacturedDate)
    {
        $this->manufacturedDate = $manufacturedDate;

        return $this;
    }

    /**
     * Get the value of expiryDate
     */ 
    public function getExpiryDate()
    {
        return $this->expiryDate;
    }

    /**
     * Set the value of expiryDate
     *
     * @return  self
     */ 
    public function setExpiryDate($expiryDate)
    {
        $this->expiryDate = $expiryDate;

        return $this;
    }

    /**
     * Get the value of gtin
     */ 
    public function getGtin()
    {
        return $this->gtin;
    }

    /**
     * Set the value of gtin
     *
     * @return  self
     */ 
    public function setGtin($gtin)
    {
        $this->gtin = $gtin;

        return $this;
    }

    /**
     * Get the value of serialNumber
     */ 
    public function getSerialNumber()
    {
        return $this->serialNumber;
    }

    /**
     * Set the value of serialNumber
     *
     * @return  self
     */ 
    public function setSerialNumber($serialNumber)
    {
        $this->serialNumber = $serialNumber;

        return $this;
    }

    /**
     * Get the value of lotNumber
     */ 
    public function getLotNumber()
    {
        return $this->lotNumber;
    }

    /**
     * Set the value of lotNumber
     *
     * @return  self
     */ 
    public function setLotNumber($lotNumber)
    {
        $this->lotNumber = $lotNumber;

        return $this;
    }

    /**
     * Get the value of packageDetails
     */ 
    public function getPackageDetails()
    {
        return $this->packageDetails;
    }

    /**
     * Set the value of packageDetails
     *
     * @return  self
     */ 
    public function setPackageDetails($packageDetails)
    {
        $this->packageDetails = $packageDetails;

        return $this;
    }

    /**
     * Get the value of manufacturerId
     */ 
    public function getManufacturerId()
    {
        return $this->manufacturerId;
    }

    /**
     * Set the value of manufacturerId
     *
     * @return  self
     */ 
    public function setManufacturerId($manufacturerId)
    {
        $this->manufacturerId = $manufacturerId;

        return $this;
    }
}