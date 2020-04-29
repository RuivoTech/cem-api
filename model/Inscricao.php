<?php

class Inscricao {
    public $explicitType = "inscricao";
    public $id;
    public $nome;
    public $email;
    public $celular;
    public $chEsEvento;
    public $evento;
    public $pago;
    
    public function __construct($row = array()) {
        $this->setId($row["id"]);
        $this->setNome($row["nome"]);
        $this->setEmail($row["email"]);
        $this->setCelular($row["celular"]);
        $this->setChEsEvento($row["chEsEvento"]);
        $this->setEvento($row["evento"]);
        $this->setPago($row["pago"]);
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
    public function getChEsEvento()
    {
        return $this->chEsEvento;
    }

    /**
     * @param mixed $chEsEvento
     */
    public function setChEsEvento($chEsEvento)
    {
        $this->chEsEvento = $chEsEvento;
    }

    /**
     * @return mixed
     */
    public function getEvento()
    {
        return $this->evento;
    }

    /**
     * @param mixed $evento
     */
    public function setEvento($evento)
    {
        $this->evento = $evento;
    }

    /**
     * @return mixed
     */
    public function getPago()
    {
        return $this->pago;
    }

    /**
     * @param mixed $pago
     */
    public function setPago($pago)
    {
        $this->pago = $pago;
    }
}

