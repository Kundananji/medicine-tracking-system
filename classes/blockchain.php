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
        $this->chain = json_decode(fread($handle,filesize($path)));
        fclose($handle);

        $this->difficulty = 5;
    }

    public function getLatestBlock() {
        return $this->chain[count($this->chain) - 1];
    }

    public function addBlock($newBlock) {
        $newBlock->previousHash = $this->getLatestBlock()->hash;
        $newBlock->mineBlock($this->difficulty);
        $index = $this->chain == null?0:sizeof($this->chain);
        $newBlock->index = $index; //get last index of transaction
        array_push($this->chain, $newBlock);

        //record chain to database
        $rootPath ="../databases";
        if(!is_dir($rootPath)){
            mkdir($rootPath);
        }
        $path ="$rootPath/blockchain.json";
        $handle= fopen($path,"a+");
        fwrite($handle,json_encode($this->chain));
        fclose($handle);
    }

    public function isValid() {
        for ($i = 1; $i < count($this->chain); $i++) {
            $currentBlock = $this->chain[$i];
            $previousBlock = $this->chain[$i - 1];

            if ($currentBlock->hash !== $currentBlock->calculateHash()) {
                return false;
            }

            if ($currentBlock->previousHash !== $previousBlock->hash) {
                return false;
            }
        }
        return true;
    }

    public function jsonSerialize()
    {
      return get_object_vars($this);
    }
}