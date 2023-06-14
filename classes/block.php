<?php 

class Block implements JsonSerializable{
    public $index = 0;
    public $timestamp;
    public $data;
    public $previousHash;
    public $hash;
    public $nonce;

    public function __construct($timestamp=null, $data=null, $previousHash = '') {

        $this->timestamp = $timestamp;
        $this->data = $data;
        $this->previousHash = $previousHash;
        $this->nonce = 0;
        $this->hash = $this->calculateHash();
    }

    public function calculateHash() {
        return hash('sha256', $this->index . $this->previousHash . $this->timestamp . preg_replace('/\s+/', '',json_encode($this->data)) . $this->nonce);
    }

    public function mineBlock($difficulty) {
        while (substr($this->hash, 0, $difficulty) !== str_repeat("0", $difficulty)) {
            $this->nonce++;
            $this->hash = $this->calculateHash();
        }
    }

    public function jsonSerialize()
    {
      return get_object_vars($this);
    }
}