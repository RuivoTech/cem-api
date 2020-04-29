<?php
/**
 * Description of Contato
 *
 * @author Richieri
 */
class Contato {
    public $explicitType = "contato";
    public $id;
    public $email;
    public $telefone;
    public $celular;
    
    public function __construct($row = array()) {
        $this->setId($row["id"]);
        $this->setEmail($row["email"]);
        $this->setTelefone($row["telefone"]);
        $this->setCelular($row["celular"]);
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
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * @return mixed
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param mixed $telefone
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    /**
     * @param mixed $celular
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;
    }

    
    
}
