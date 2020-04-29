<?php

class Visitante{
    public $explicitType = "visitante";
    public $id;
    public $nome;
    public $email;
    public $telefone;
    public $celular;
    public $cep;
    public $logradouro;
    public $complemento;
    public $dataVisita;
    public $religiao;
    public $visita;
    
    public function __construct($row = null){
        if (!empty($row)) {
            $this->setId($row["id"]);
            $this->setNome($row["nome"]);
            $this->setEmail($row["email"]);
            $this->setTelefone($row["telefone"]);
            $this->setCelular($row["celular"]);
            $this->setCep($row["cep"]);
            $this->setLogradouro($row["logradouro"]);
            $this->setComplemento($row["complemento"]);
            $this->setDataVisita($row["dataVisita"]);
            $this->setReligiao($row["religiao"]);
            $this->setVisita($row["visita"]);
        }else{
            $this->setId(0);
        }
    }
    
    public function ehNovo(){
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
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * @param mixed $celular
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;
    }

    /**
     * @return mixed
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * @param mixed $cep
     */
    public function setCep($cep)
    {
        $this->cep = $cep;
    }

    /**
     * @return mixed
     */
    public function getLogradouro()
    {
        return $this->logradouro;
    }

    /**
     * @param mixed $endereco
     */
    public function setLogradouro($logradouro)
    {
        $this->logradouro = $logradouro;
    }

    /**
     * @return mixed
     */
    public function getComplemento()
    {
        return $this->complemento;
    }

    /**
     * @param mixed $complemento
     */
    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;
    }

    /**
     * @return mixed
     */
    public function getDataVisita()
    {
        return $this->dataVisita;
    }

    /**
     * @param mixed $dataVisita
     */
    public function setDataVisita($dataVisita)
    {
        $this->dataVisita = $dataVisita;
    }

    /**
     * @return mixed
     */
    public function getReligiao()
    {
        return $this->religiao;
    }

    /**
     * @param mixed $religiao
     */
    public function setReligiao($religiao)
    {
        $this->religiao = $religiao;
    }

    /**
     * @return mixed
     */
    public function getVisita()
    {
        return $this->visita;
    }

    /**
     * @param mixed $visita
     */
    public function setVisita($visita)
    {
        $this->visita = $visita;
    }
}