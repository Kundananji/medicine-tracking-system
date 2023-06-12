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

$server = stream_socket_server("tcp://0.0.0.0:$port", $errno, $errorMessage);
if ($server === false) {
    die("Failed to create socket: $errorMessage");
}

echo "Server listening on $host:$port\n";

$mTransaction = new Transaction(); //create new instance of transaction

$blockchain = new Blockchain(); // create a new instance of the blockchain
$lastSend  = 0;
$lastSendBlockChain = time();

$sending = "sending";
$receiving="receiving";

$currentOperation = $receiving;

//server will be in either receiving or sending state
while (true) {

    $blockchain = new Blockchain();
    $miners =  $user->getMiners();

    //fetch java peers from database
    $java_peers = [];
    foreach($miners as $miner){
        $java_peers[]=$miner->getIpAddress();
    }

    if($currentOperation == $receiving){

    echo "Waiting for client to connect\n\n";
    $client = stream_socket_accept($server);
  
    if($client){
        echo "New client connected to PHP server\n\n";
        $data = stream_get_contents($client); // read incoming data from client
        $transaction = json_decode($data,true); // decode transaction data from JSON

        echo"Received Data from Client: $data\n\n";
        //type of data received can be a block, or a whole blockchain

  

        if($transaction["type"]=="block"){

            echo"Received block from network.\n";

            $mBlock = $transaction['data'];

            $receivedBlock = new Block();

            $receivedBlock->index = $mBlock['index'];
            $receivedBlock->timestamp =$mBlock['timestamp'];
            $receivedBlock->data = $mBlock['data'];
            $receivedBlock->previousHash = isset($mBlock['previousHash'])?$mBlock['previousHash']:null;
            $receivedBlock->hash = isset($mBlock['hash'])?$mBlock['hash']:null;
            $receivedBlock->nonce = $mBlock['nonce'];

            //add transaction to local block       
            //$blockchain->addBlock(new Block( time(), $transactionBlock));
            $block = $blockchain->getLatestBlock(); 

            //accept block if its previous hash matches with the has of the previous block on your chain
            //or if you have no block and its previous hash is null: implies it is the first in the block
            if($block->hash == $receivedBlock->previousHash || $block==null && $receivedBlock->previousHash == null){
                $blockchain->addBlock(new Block( time(), $transactionBlock)); 
                echo"New Received Block has been added to blockchain\n";
            }
            else
            if($block->hash == $receivedBlock->hash ){
                echo"New block already exists on current blockchain\n";
            }
            else{
                echo"Received block discarded because it is invalid\n";
            }

        }

        if($transaction["type"]=="blockchain"){

            echo"Received blockchain from network.\n";

            $chain = $transaction["data"];

    

            $blocks = [];
            //chain is an array
            foreach($chain as $item){
                $block = new Block();
                foreach($item as $key=>$value){
                    $block->$key = $value;
                }

                //add to blocks
                $blocks[]=$block;

            }

            //temporarily store old chain
            $oldChain = $blockchain->chain;


            //check length of your chain
            if(sizeof($blockchain->chain) < sizeof($blocks)){
                //received chain is longer, 
                //replace local chain with this one

                $blockchain->chain = $blocks;

                if($blockchain->isValid()){
                  echo"Discarded own blockchain for received block\n";
                //  $blockchain->SaveBlockchain();
                }
                else{
                    echo"Received blockchain is not valid, discarded\n";
                    $blockchain->chain = $oldChain;
                }
            }



        }
    }
    $currentOperation =$sending;
   }
   else{
 

    //fetch one transaction at a time
    $transactions = $mTransaction->getPendingRecords(1);
    $transaction = null;
    if(sizeof($transactions)>0){
        $transaction = $transactions[0];
    }



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

           $medicineArray[] = array(
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

        broadcast(json_encode($data));

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

    //send blockchain to network every 60 seconds
    if(time() - $lastSendBlockChain > 60){
       $chain =  $blockchain->chain;
       if($chain!=null && sizeof($chain)>0){

        // broadcast blockchain to Java peers
        $data = array(
            "type"=>"blockchain",
            "data"=>$chain
        );

        broadcast(json_encode($data));
        
        echo "Broadcasting blockchain\n";    


       }

        $lastSendBlockChain = time();
    }

    $currentOperation =$receiving;

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
