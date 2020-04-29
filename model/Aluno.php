<?php

class Aluno {
    public $explicitType = "aluno";
    public $id;
    public $nome;
    public $email;
    public $rg;
    public $telefone;
    public $endereco;
    
    public function __construct($row = array()) {
        if(!Empty($row)) {
            $this->setId($row["id"]);
            $this->setNome($row["nome"]);
            $this->setEmail($row["email"]);
            $this->setRg($row["rg"]);
            $this->setTelefone($row["telefone"]);
            $this->setEndereco($row["endereco"]);
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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getRg()
    {
        return $this->rg;
    }

    /**
     * @param mixed $rg
     */
    public function setRg($rg)
    {
        $this->rg = $rg;
    }

    /**
     * @return mixed
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * @param mixed $telefone
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    /**
     * @return mixed
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * @param mixed $endereco
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }

}

