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

        // wait for connection from PHP peer
        Socket clientSocket = serverSocket.accept();

        // create input and output streams for communication
        BufferedReader in = new BufferedReader(new InputStreamReader(clientSocket.getInputStream()));
        PrintWriter out = new PrintWriter(clientSocket.getOutputStream(), true);

        // create scanner for user input
        Scanner scanner = new Scanner(System.in);

        // create thread for receiving messages from PHP peer
        Thread receiveThread = new Thread(() -> {
            try {
                while (true) {
                    // read message from PHP peer
                    String message = in.readLine();
                    System.out.println("Received message from PHP peer: " + message);
                }
            } catch (Exception e) {
                e.printStackTrace();
            }
        });
        receiveThread.start();

        // send messages to PHP peer
        while (true) {
            // read message from user
            System.out.print("Enter message to send to PHP peer: ");
            String message = scanner.nextLine();

            // send message to PHP peer
            out.println(message);
        }
    }
}
