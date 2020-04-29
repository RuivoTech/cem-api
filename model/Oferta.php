<?php

class Oferta {
    public $explicitType = "oferta";
    public $id;
    public $dataOferta;
    public $valorOferta;
    
    public function __construct($row = array()) {
        $this->setId($row["id"]);
        $this->setDataOferta($row["dataOferta"]);
        $this->setValorOferta($row["valorOferta"]);
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
    public function getDataOferta()
    {
        return $this->dataOferta;
    }

    /**
     * @param mixed $dataOferta
     */
    public function setDataOferta($dataOferta)
    {
        $this->dataOferta = $dataOferta;
    }

    /**
     * @return mixed
     */
    public function getValorOferta()
    {
        return $this->valorOferta;
    }

    /**
     * @param mixed $valorOferta
     */
    public function setValorOferta($valorOferta)
    {
        $this->valorOferta = $valorOferta;
    }

    
    
}

