<?php

class Dizimo {
    public $explicitType = "dizimo";
    public $id;
    public $idMembro;
    public $dataDizimo;
    public $valorDizimo;
    public $nome;
    
    public function __construct($row) {
        $this->setId($row["id"]);
        $this->setIdMembro($row["idMembro"]);
        $this->setDataDizimo($row["dataDizimo"]);
        $this->setValorDizimo($row["valorDizimo"]);
        $this->setNome($row["nome"]);
    }
    
    public function ehNovo(){
        return !$this->getId() > 0;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function getIdMembro() {
        return $this->idMembro;
    }
    
    public function setIdMembro($idMembro) {
        $this->idMembro = $idMembro;
    }
    
    public function getDataDizimo() {
        return $this->dataDizimo;
    }
    
    public function setDataDizimo($dataDizimo) {
        $this->dataDizimo = $dataDizimo;
    }
    
    public function getValorDizimo() {
        return $this->valorDizimo;
    }
    
    public function setValorDizimo($valorDizimo) {
        $this->valorDizimo = $valorDizimo;
    }
    
    public function getNome() {
        return $this->nome;
    }
    
    public function setNome($nome) {
        $this->nome = $nome;
    }
}
