<?php

class Ministerio {
    public $explicitType = "ministerio";
    public $id;
    public $nome;
    public $descricao;
    
    public function __construct($row = array()) {
        if(!Empty($row)){
            $this->setId($row["id"]);
            $this->setNome($row["nome"]);
            $this->setDescricao($row["descricao"]);
        }else{
            $this->setId(0);
        }
    }
    
    public function ehNovo() {
        return !$this->getId() > 0;
    }
    
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }
}

