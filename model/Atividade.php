<?php

class Atividade {
    public $explicitType = "atividade";
    public $id;
    public $descricao;
    public $idTipo;
    public $chEsModulo;
    public $modulo;
    public $data;
    
    public function __construct($row = array()) {
        if(!Empty($row)){
            $this->setId($row["id"]);
            $this->setDescricao($row["descricao"]);
            $this->setIdTipo($row["idTipo"]);
            $this->setchEsModulo($row["chEsModulo"]);
            $this->setModulo($row["modulo"]);
            $this->setData($row["data"]);
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

    /**
     * @return mixed
     */
    public function getIdTipo()
    {
        return $this->idTipo;
    }

    /**
     * @param mixed $idTipo
     */
    public function setIdTipo($idTipo)
    {
        $this->idTipo = $idTipo;
    }

    /**
     * @return mixed
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param mixed $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * @return mixed
     */
    public function getChEsModulo()
    {
        return $this->chEsModulo;
    }

    /**
     * @param mixed $chEsModulo
     */
    public function setChEsModulo($chEsModulo)
    {
        $this->chEsModulo = $chEsModulo;
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
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }


}

