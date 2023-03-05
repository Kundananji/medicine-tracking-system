<?php

include('../classes/blockchain.php');
include('../classes/block.php');
include('../classes/database.php');
include('../classes/user.php');
include('../classes/typeoftransaction.php');
include('../classes/transaction.php');
include('../classes/transactionrole.php');
include('../classes/transactionactor.php');
include('../classes/medicine.php');
include('../classes/transactionmedicine.php');

$user = new User();
$mActor = new TransactionActor();
$mTransactionMedicine = new TransactionMedicine();

$host = 'localhost';
$port = 8000;

$server = stream_socket_server("tcp://$host:$port", $errno, $errorMessage);
if ($server === false) {
    die("Failed to create socket: $errorMessage");
}

echo "Server listening on $host:$port\n";

$mTransaction = new Transaction(); //create new instance of transaction

$blockchain = new Blockchain(); // create a new instance of the blockchain
$lastSend  = 0;


while (true) {

    $miners =  $user->getMiners();

    //fetch java peers from database
    $java_peers = [];
    foreach($miners as $miner){
        $java_peers[]=$miner->getIpAddress();
    }

    $client = stream_socket_accept($server);
  
    if($client){
        echo "New client connected to PHP server\n\n";
        $data = stream_get_contents($client); // read incoming data from client
        $transaction = json_decode($data, true); // decode transaction data from JSON

        echo"Received Data from Client: $transaction\n\n";

        //type of data received can be a block, or a whole blockchain
    }
 

    //fetch one transaction at a time
    $transactions = $mTransaction->getPendingRecords(1);
    $transaction = null;
    if(sizeof($transactions)>0){
        $transaction = $transactions[0];
    }

    $blockchain = new Blockchain();

    //broadcast java peers only if we send 60 seconds or more agao
    if(count($java_peers) > 0 && time() - $lastSend  > 60){

        $mPeers = [];

        foreach($java_peers as $key=>$value){
          $hostParts = explode(":",$value);  
          $mPeers[]=array(
            "host"=> $hostParts[0],
            "port"=> $hostParts[1]
          );
        }

        $data = array(
            "type"=>"peers",
            "data"=>$mPeers
        );

        broadcast(json_encode($data));
        $lastSend = time();

    }

    if($transaction !=null){         

        //get actors
        $actors = $mActor->getRecordsByTransactionId($transaction->getId());
        $actorsArray =[];
        foreach($actors as $actor){
            $actorsArray[]=array(
              "actorId"=>$actor->getUserId(),
              "name"=>$actor->getActor()->getName(),
              "role"=>$actor->getRole()->getName()              
            );
        }

        //get medicines
        $medicines = $mTransactionMedicine->getMedicineByTransactionId($transaction->getId());

        $medicineArray = [];

        foreach($medicines as $transactionMedicine){

           $medicineArray = array(
            "medicineId"=>$transactionMedicine->getMedicine()->getId(),
            "name"=>$transactionMedicine->getMedicine()->getName(),
            "description"=> $transactionMedicine->getMedicine()->getDescription(),
            "manufacturedDate"=> $transactionMedicine->getMedicine()->getManufacturedDate(),
            "expiryDate"=> $transactionMedicine->getMedicine()->getExpiryDate(),
            "gtin"=> $transactionMedicine->getMedicine()->getGtin(),
            "serialNumber"=> $transactionMedicine->getMedicine()->getSerialNumber(),
            "lotNumber"=> $transactionMedicine->getMedicine()->getLotNumber(),
            "packageDetails"=> $transactionMedicine->getMedicine()->getPackageDetails(),
            "manufacturerId"=> $transactionMedicine->getMedicine()->getManufacturerId(),
            "manufacturerName"=> $transactionMedicine->getMedicine()->getManufacturer()->getName(),
            "details"=> $transactionMedicine->getDetails(),
            "quantity"=>$transactionMedicine->getQuantity(),
            "amount"=>$transactionMedicine->getAmount()
          
           );

        }

        //create transaction block
        $transactionBlock = array(
            "transactionId"=>$transaction->getId(),
            "dateOfTransaction"=>$transaction->getDateOfTransaction(),
            "details"=>$transaction->getDetails(),
            "location"=>$transaction->getLocation(),
            "transactionType"=>$transaction->getTransactionType()->getName(),
            "actors"=>$actorsArray,
            "medicines"=>$medicineArray 
        );

        //update to synced
        $transaction->markAsSynced();

        // broadcast the new transaction to the Java peers to add to their blockchain
        $data = array(
            "type"=>"transaction",
            "data"=>$transactionBlock
        );

        broadcast(json_encode($transactionBlock));

        //add transaction to local block       
        $blockchain->addBlock(new Block( time(), $transactionBlock));
        $block = $blockchain->getLatestBlock(); 

        // broadcast the new block to the Java peers
        $data = array(
            "type"=>"block",
            "data"=>$block
        );

        broadcast(json_encode($data));
        echo "New block added to the blockchain\n";     

    }


}

function broadcast($data) {
    global $user;
    global $java_peers;
    // broadcast the data to all Java peers   
    foreach ($java_peers as $java_peer) {
        echo"Sending to $java_peer : $data\n\n";
        $socket = stream_socket_client("tcp://$java_peer", $errno, $errorMessage, 10);
        if ($socket === false) {
            echo "Failed to connect to $java_peer: $errorMessage\n";
            continue;
        }
        fwrite($socket, $data);
        fclose($socket);
    }
}
