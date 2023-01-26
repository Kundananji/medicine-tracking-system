<?php
class Database{
	//only one copy of these variables exist throughout the program
    static $host="localhost";
    static $databaseUser="root";
    static $database="mts";
    static $password="";
    static $connection=null;

   public static function getConnection(){
	    if(self::$connection!=null){
			return self::$connection;
		}
        $driver = new mysqli_driver();
		$driver->report_mode = MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR;
		//enable reporting of errors
		try{

		    self::$connection = new mysqli(self::$host, self::$databaseUser,self::$password,self::$database);
		    self::$connection->set_charset("utf8");		     
		   } 
		  catch(Exception $e) {
		  	 throw $e;
		}
		return self::$connection;
    }
}