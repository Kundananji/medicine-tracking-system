<?php
 class user{
    private $id; 
    private $name; 
    private $address; 
    private $email; 
    private $username; 
    private $password; 
    private $userTypeId;

    public function getUsers(){
        return [];
    }

    public function extractUser($row){
        $mUser = new User();
        $mUser->setId($row['ID']);
        $mUser->setName($row['Name']);
        $mUser->setAddress($row['Address']);
        $mUser->setEmail($row['Email']);
        $mUser->setUsername($row['Username']);
        $mUser->setPassword($row['Password']);
        $mUser->setUserTypeId($row['User_Type_ID']);

        return $mUser;
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
     * Get the value of address
     */ 
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of address
     *
     * @return  self
     */ 
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of userTypeId
     */ 
    public function getUserTypeId()
    {
        return $this->userTypeId;
    }

    /**
     * Set the value of userTypeId
     *
     * @return  self
     */ 
    public function setUserTypeId($userTypeId)
    {
        $this->userTypeId = $userTypeId;

        return $this;
    }
}