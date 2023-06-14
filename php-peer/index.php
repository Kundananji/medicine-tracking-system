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





$blockchain = new Blockchain(); // create a new instance of the blockchain
// Check if the pthreads extension is loaded
if (!extension_loaded('pthreads')) {
    die('The pthreads extension is not loaded.');
}
// Thread class for listening
class ListeningThread extends Thread
{
    public function run()
    {
        $host = 'localhost';
        $port = 8000;
        $server = stream_socket_server("tcp://0.0.0.0:$port", $errno, $errorMessage);
        if ($server === false) {
            die("Failed to create socket: $errorMessage");
        }

        echo "Server listening on $host:$port\n";
   
        //listening loop
        while (true) {

            $blockchain = new Blockchain();

            echo "Waiting for client to connect\n\n";
            $client = stream_socket_accept($server);
            //wait for a moment for client to connect
            if ($client) {
                echo "New client connected to PHP server\n\n";
                $data = stream_get_contents($client); // read incoming data from client
                $transaction = json_decode($data, true); // decode transaction data from JSON

                echo "Received Data from Client: $data\n\n";
                //type of data received can be a block, or a whole blockchain  

                if ($transaction["type"] == "block") {

                    echo "Received block from network.\n";

                    $mBlock = $transaction['data'];

                    $receivedBlock = new Block();

                    $receivedBlock->index = $mBlock['index'];
                    $receivedBlock->timestamp = $mBlock['timestamp'];
                    $receivedBlock->data = $mBlock['data'];
                    $receivedBlock->previousHash = isset($mBlock['previousHash']) ? $mBlock['previousHash'] : null;
                    $receivedBlock->hash = isset($mBlock['hash']) ? $mBlock['hash'] : null;
                    $receivedBlock->nonce = $mBlock['nonce'];


                    //$blockchain->addBlock(new Block( time(), $transactionBlock));
                    $block = $blockchain->getLatestBlock();               

                    //accept block if its previous hash matches with the has of the previous block on your chain
                    //or if you have no block and its previous hash is null: implies it is the first in the block
                    if ($block->hash == $receivedBlock->previousHash || $block == null && $receivedBlock->previousHash == null) {
                        $blockchain->addBlock($receivedBlock,false);
                        echo "New Received Block has been added to blockchain\n";
                    } else
                    if ($block->hash == $receivedBlock->hash) {
                                echo "New block already exists on current blockchain\n";
                            } else {
                                echo "Received block discarded because it is invalid\n";
                            }
                        }

                if ($transaction["type"] == "blockchain") {

                    echo "Received blockchain from network.\n";

                    $chain = $transaction["data"];



                    $blocks = [];
                    //chain is an array
                    foreach ($chain as $item) {
                        $block = new Block();
                        foreach ($item as $key => $value) {
                            $block->$key = $value;
                        }

                        //add to blocks
                        $blocks[] = $block;
                    }

                    //temporarily store old chain
                    $oldChain = $blockchain->chain;


                    //check length of your chain
                    if (sizeof($blockchain->chain) < sizeof($blocks)) {
                        //received chain is longer, 
                        //replace local chain with this one

                        $blockchain->chain = $blocks;

                        if ($blockchain->isValid()) {
                            echo "Discarded own blockchain for received block\n";
                            //  $blockchain->SaveBlockchain();
                        } else {
                            echo "Received blockchain is not valid, discarded\n";
                            $blockchain->chain = $oldChain;
                        }
                    } else {
                        echo "Received blockchain is not longer than local. Discarded.\n";
                    }
                }
            }
        }
    }
}

// Thread class for sending messages
class SendingThread extends Thread
{
    var $java_peers = [];
    public function run()
    {
        $user = new User();
        $mActor = new TransactionActor();
        $mTransactionMedicine = new TransactionMedicine();
        $mTransaction = new Transaction(); //create new instance of transaction
  
        //sending loop
        while (true) {

            $blockchain = new Blockchain();
            $miners =  $user->getMiners();

            //fetch java peers from database
       
            foreach ($miners as $miner) {
                $this->java_peers[] = $miner->getIpAddress();
            }


            //fetch one transaction at a time
            $transactions = $mTransaction->getPendingRecords(1);
            $transaction = null;
            if (sizeof($transactions) > 0) {
                $transaction = $transactions[0];
            }

              //broadcasting to peers
                $mPeers = [];
                foreach ($this->java_peers as $key => $value) {
                    $hostParts = explode(":", $value);
                    $mPeers[] = array(
                        "host" => $hostParts[0],
                        "port" => $hostParts[1]
                    );
                }

                $data = array(
                    "type" => "peers",
                    "data" => $mPeers
                );

                $this->broadcast(json_encode($data));
      

            if ($transaction != null) {

                //get actors
                $actors = $mActor->getRecordsByTransactionId($transaction->getId());
                $actorsArray = [];
                foreach ($actors as $actor) {
                    $actorsArray[] = array(
                        "actorId" => $actor->getUserId(),
                        "name" => $actor->getActor()->getName(),
                        "role" => $actor->getRole()->getName()
                    );
                }

                //get medicines
                $medicines = $mTransactionMedicine->getMedicineByTransactionId($transaction->getId());

                $medicineArray = [];

                foreach ($medicines as $transactionMedicine) {

                    $medicineArray[] = array(
                        "medicineId" => $transactionMedicine->getMedicine()->getId(),
                        "name" => $transactionMedicine->getMedicine()->getName(),
                        "description" => $transactionMedicine->getMedicine()->getDescription(),
                        "manufacturedDate" => $transactionMedicine->getMedicine()->getManufacturedDate(),
                        "expiryDate" => $transactionMedicine->getMedicine()->getExpiryDate(),
                        "gtin" => $transactionMedicine->getMedicine()->getGtin(),
                        "serialNumber" => $transactionMedicine->getMedicine()->getSerialNumber(),
                        "lotNumber" => $transactionMedicine->getMedicine()->getLotNumber(),
                        "packageDetails" => $transactionMedicine->getMedicine()->getPackageDetails(),
                        "manufacturerId" => $transactionMedicine->getMedicine()->getManufacturerId(),
                        "manufacturerName" => $transactionMedicine->getMedicine()->getManufacturer()->getName(),
                        "details" => $transactionMedicine->getDetails(),
                        "quantity" => $transactionMedicine->getQuantity(),
                        "amount" => $transactionMedicine->getAmount()

                    );
                }

                //create transaction block
                $transactionBlock = array(
                    "transactionId" => $transaction->getId(),
                    "dateOfTransaction" => $transaction->getDateOfTransaction(),
                    "details" => $transaction->getDetails(),
                    "location" => $transaction->getLocation(),
                    "transactionType" => $transaction->getTransactionType()->getName(),
                    "actors" => $actorsArray,
                    "medicines" => $medicineArray
                );

                //update to synced
                $transaction->markAsSynced();

                //add transaction to local block       
                $blockchain->addBlock(new Block(time(), $transactionBlock));
                $block = $blockchain->getLatestBlock();

                // broadcast the new block to the Java peers
                $data = array(
                    "type" => "block",
                    "data" => $block
                );
                $this->broadcast(json_encode($data));

                echo "New block added to the blockchain\n";
            }


            $chain =  $blockchain->chain;
            if ($chain != null && sizeof($chain) > 0) {

                // broadcast blockchain to Java peers
                $data = array(
                    "type" => "blockchain",
                    "data" => $chain
                );

                $this->broadcast(json_encode($data));

                echo "Broadcasting blockchain\n";
            }
        }
    }

function broadcast($data)
{

    // broadcast the data to all Java peers   
    foreach ($this->java_peers as $java_peer) {
        echo "Sending to $java_peer : $data\n\n";
        $socket = stream_socket_client("tcp://$java_peer", $errno, $errorMessage, 10);
        if ($socket === false) {
            echo "Failed to connect to $java_peer: $errorMessage\n";
            continue;
        }
        fwrite($socket, $data);
        fclose($socket);
    }
}
}

// Create instances of the thread classes
$listeningThread = new ListeningThread();
$sendingThread = new SendingThread();

// Start the threads
$listeningThread->start();
$sendingThread->start();

// Do some other work in the main script

// Wait for the threads to finish
$listeningThread->join();
$sendingThread->join();








