<?php

include('../classes/blockchain.php');
include('../classes/block.php');
include('../classes/database.php');
include('../classes/user.php');

$user = new User();

$host = 'localhost';
$port = 8000;

$server = stream_socket_server("tcp://$host:$port", $errno, $errorMessage);
if ($server === false) {
    die("Failed to create socket: $errorMessage");
}

echo "Server listening on $host:$port\n";

$blockchain = new Blockchain(); // create a new instance of the blockchain

while (true) {
    $client = stream_socket_accept($server);
    echo "New client connected\n";
    
    $data = stream_get_contents($client); // read incoming data from client
    $transaction = json_decode($data, true); // decode transaction data from JSON
    
    //read file to see if there is a transaction
    $rootPath ="../databases";
    if(!is_dir($rootPath)){
        mkdir($rootPath);
    }
    $path ="$rootPath/current_transaction.json";
    $handle= fopen($path,"r+");
    $fileSize = filesize($path)==0?1024:filesize($path);
    $transaction = fread($handle,$fileSize);
    //remote the data
    fwrite($handle,"");
    fclose($handle);

    $blockchain = new Blockchain();
    if($transaction !=null){  
        
        // broadcast the new transaction to the Java peers to add to their blockchain
        $data = array(
            "type"=>"transaction",
            "data"=>$block
        );
        broadcast(json_encode($data));

        //add transaction to local block       
        $blockchain->addBlock(new Block( time(), json_encode($transaction)));

        $block = $blockchain->getLatestBlock(); 

        // broadcast the new block to the Java peers
        $data = array(
            "type"=>"block",
            "data"=>$block
        );

        broadcast(json_encode($data));
        echo "New block added to the blockchain:\n";
        print_r($block);

    }


}

function broadcast($data) {
    global $user;
    $miners =  $user->getMiners();

     //fetch java peers from database
    $java_peers = [];
    foreach($miners as $miner){
        $java_peers[]=$miner->getIpAddress();
    }

    // broadcast the data to all Java peers   
    foreach ($java_peers as $java_peer) {
        $socket = stream_socket_client("tcp://$java_peer", $errno, $errorMessage, 10);
        if ($socket === false) {
            echo "Failed to connect to $java_peer: $errorMessage\n";
            continue;
        }
        fwrite($socket, $data);
        fclose($socket);
    }
}
