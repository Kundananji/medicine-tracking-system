<?php
 require('../classes/database.php');
 require('../classes/medicine.php');
  require("../classes/user.php");

  $searchText = filter_var($_GET['searchText'],FILTER_SANITIZE_SPECIAL_CHARS);


$medicine = new Medicine();
// fetch all records from database
$records = $medicine->search($searchText);

echo json_encode(array(
    "medicines" =>$records
));