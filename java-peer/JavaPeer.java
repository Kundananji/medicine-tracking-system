import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.io.PrintWriter;
import java.net.ServerSocket;
import java.net.Socket;
import java.util.Scanner;

public class JavaPeer {
    public static void main(String[] args) throws Exception {
        // create server socket
        ServerSocket serverSocket = new ServerSocket(12345);

        // create array to hold connected client sockets
        Socket[] clientSockets = new Socket[10];
        int numClients = 0;

        while (true) {
            // wait for connection from PHP peer
            Socket phpSocket = serverSocket.accept();
            System.out.println("New connection from PHP peer");

            // create input and output streams for communication with PHP peer
            BufferedReader in = new BufferedReader(new InputStreamReader(phpSocket.getInputStream()));
            PrintWriter out = new PrintWriter(phpSocket.getOutputStream(), true);

            // create thread for receiving messages from PHP peer
            Thread receiveThread = new Thread(() -> {
                try {
                    while (true) {
                        // read message from PHP peer
                        String message = in.readLine();
                        System.out.println("Received message from PHP peer: " + message);

                        // send message to all connected Java peers
                        for (int i = 0; i < numClients; i++) {
                            Socket clientSocket = clientSockets[i];
                            PrintWriter clientOut = new PrintWriter(clientSocket.getOutputStream(), true);
                            clientOut.println(message);
                        }
                    }
                } catch (Exception e) {
                    e.printStackTrace();
                }
            });
            receiveThread.start();

            // add PHP peer socket to array of connected client sockets
            clientSockets[numClients++] = phpSocket;
        }
    }
}
