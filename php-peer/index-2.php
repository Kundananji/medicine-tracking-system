<?php

require_once('blockchain.php'); // import the blockchain library
require_once('db.php'); // import the database connection settings

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
    
    // insert the transaction into the database
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $sql = "INSERT INTO transactions (sender, receiver, amount) VALUES ('{$transaction['sender']}', '{$transaction['receiver']}', '{$transaction['amount']}')";
    mysqli_query($conn, $sql);
    mysqli_close($conn);
    
    // create a new block containing the transaction data
    $last_block = $blockchain->lastBlock();
    $new_block = $blockchain->newBlock($transaction);
    
    // broadcast the new block to the Java peers
    $json_block = json_encode($new_block); // stringify the new block as JSON
    broadcast($json_block);
    
    echo "New block added to the blockchain:\n";
    print_r($new_block);
}

function broadcast($data) {
    // broadcast the data to all Java peers
    $java_peers = array("localhost:9000", "localhost:9001", "localhost:9002");
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
