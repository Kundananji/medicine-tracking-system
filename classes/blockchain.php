<?php
class Blockchain implements JsonSerializable{
    public $chain;
    public $difficulty;

    public function __construct() {
    
        //read blockchain database
        $rootPath ="../databases";
        if(!is_dir($rootPath)){
            mkdir($rootPath);
        }
        $path ="$rootPath/blockchain.json";
        $handle= fopen($path,"a+");
        $fileSize = filesize($path)==0?1024:filesize($path);
        $data = json_decode(fread($handle,$fileSize));
        if($data == null){
            $this->chain = [];//empty array
        }
        else{
         $this->chain = $data;
        }
        fclose($handle);

        $this->difficulty = 5;
    }

    public function getLatestBlock() {
        return $this->chain!=null &&sizeof($this->chain)>0?$this->chain[count($this->chain) - 1]:null;
    }

    public function addBlock($newBlock,$mined=true) {
        $newBlock->previousHash = $this->getLatestBlock()!=null? $this->getLatestBlock()->hash:null;
        if(!$mined){ //if this block is not mined already
            $newBlock->mineBlock($this->difficulty);
        }
        $index = $this->chain == null?0:sizeof($this->chain);
        $newBlock->index = $index; //get last index of transaction
        array_push($this->chain, $newBlock);

        //record chain to database
        $rootPath ="../databases";
        if(!is_dir($rootPath)){
            mkdir($rootPath);
        }
        $path ="$rootPath/blockchain.json";
        $handle= fopen($path,"w+");
        fwrite($handle,json_encode($this->chain));
        fclose($handle);

        echo "Adding new block to blockchain ___ \n";
    }

    public function isValid() {
        for ($i = 1; $i < count($this->chain); $i++) {
            $currentBlock = $this->chain[$i];
            $previousBlock = $this->chain[$i - 1];

            if ($currentBlock->hash !== $currentBlock->calculateHash()) {
                echo "Block '$currentBlock->index' hash '$currentBlock->hash' is not computed correctly. It's supposed to be '$currentBlock->calculateHash()'\n";
                return false;
            }

            if ($currentBlock->previousHash !== $previousBlock->hash) {
                echo "Block '$currentBlock->index' hash '$currentBlock->hash' is not equal to previous hash '$previousBlock->hash' of block '$previousBlock->index'\n";
                return false;
            }
        }
        return true;
    }

    public function SaveBlockchain(){
         //record chain to database
         $rootPath ="../databases";
         if(!is_dir($rootPath)){
             mkdir($rootPath);
         }
         $path ="$rootPath/blockchain.json";
         $handle= fopen($path,"w+");
         fwrite($handle,json_encode($this->chain));
         fclose($handle);

    }

    public function jsonSerialize()
    {
      return get_object_vars($this);
    }
}