<?php

class Modulo {
    public $explicitType = "modulo";
    public $id;
    public $modulo;
    public $ordem;
    
    public function __construct($row = array()) {
        if(!Empty($row)){
            $this->setId($row["id"]);
            $this->setModulo($row["modulo"]);
            $this->setOrdem($row["ordem"]);
        }else{
            $this->setId(0);
        }
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
    public function getModulo()
    {
        return $this->modulo;
    }

    /**
     * @param mixed $modulo
     */
    public function setModulo($modulo)
    {
        $this->modulo = $modulo;
    }

    /**
     * @return mixed
     */
    public function getOrdem()
    {
        return $this->ordem;
    }

    /**
     * @param mixed $ordem
     */
    public function setOrdem($ordem)
    {
        $this->ordem = $ordem;
    }

}

