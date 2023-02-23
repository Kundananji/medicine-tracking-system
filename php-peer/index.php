<?php
// create socket connection to Java peer
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
socket_connect($socket, 'localhost', 12345);

// send and receive messages to and from Java peer
$stdin = fopen('php://stdin', 'r');
while (true) {
    // read message from user
    echo "Enter message to send to Java peer: ";
    $message = rtrim(fgets($stdin), "\r\n");

    // send message to Java peer
    socket_write($socket, $message, strlen($message));

    // read response from Java peer
    $response = socket_read($socket, 1024);
    echo "Received response from Java peer: $response\n";
}
