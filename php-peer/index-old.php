<?php
// create socket connection to Java peers
$sockets = array();
for ($i = 0; $i < 10; $i++) {
    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    socket_connect($socket, 'localhost', 12345);
    $sockets[] = $socket;
}

// send and receive messages to and from Java peers
$stdin = fopen('php://stdin', 'r');
while (true) {
    // read message from user
    echo "Enter message to send to Java peers: ";
    $message = rtrim(fgets($stdin), "\r\n");

    // send message to all connected Java peers
    foreach ($sockets as $socket) {
        socket_write($socket, $message, strlen($message));
    }

    // read response from all connected Java peers
    while ($read = socket_read($sockets[0], 1024)) {
        echo "Received response from Java peer: $read\n";
    }
}
