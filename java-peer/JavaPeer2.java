import java.io.*;
import java.net.*;
import java.nio.charset.StandardCharsets;
import java.nio.file.Files;
import java.nio.file.Paths;
import java.util.ArrayList;

import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;

public class JavaPeer2 {
    
    private static final String FILE_NAME = "blockchain.json";
    private static ArrayList<Block> blockchain;

    public static void main(String[] args) {
        int port = 9000;
        try {
            blockchain = loadBlockchainFromFile(); // load blockchain from JSON file
            ServerSocket serverSocket = new ServerSocket(port);
            System.out.println("Server listening on port " + port);
            while (true) {
                Socket clientSocket = serverSocket.accept();
                System.out.println("New client connected");
                InputStream input = clientSocket.getInputStream();
                BufferedReader reader = new BufferedReader(new InputStreamReader(input));
                String data = reader.readLine(); // read incoming data from PHP server
                Block newBlock = new Gson().fromJson(data, Block.class); // parse incoming block data from JSON
                blockchain.add(newBlock); // add the new block to the blockchain
                System.out.println("New block added to the blockchain:");
                System.out.println(new Gson().toJson(newBlock));
                saveBlockchainToFile(blockchain); // save updated blockchain to JSON file
                clientSocket.close();
            }
        } catch (IOException e) {
            System.out.println("Error: " + e.getMessage());
        }
    }

    private static ArrayList<Block> loadBlockchainFromFile() throws IOException {
        File file = new File(FILE_NAME);
        if (!file.exists()) {
            return new ArrayList<Block>();
        }
        byte[] encoded = Files.readAllBytes(Paths.get(FILE_NAME));
        String json = new String(encoded, StandardCharsets.UTF_8);
        return new Gson().fromJson(json, new TypeToken<ArrayList<Block>>(){}.getType());
    }

    private static void saveBlockchainToFile(ArrayList<Block> blockchain) throws IOException {
        Gson gson = new Gson();
        String json = gson.toJson(blockchain);
        FileWriter writer = new FileWriter(FILE_NAME);
        writer.write(json);
        writer.close();
    }
}
