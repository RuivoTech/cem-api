<?php

class MinisterioMembro {
    public $explicitType = "ministerioMembro";
    public $id;
    public $chEsMembro;
    public $chEsMinisterio;
    public $checked;

    public function __construct($row = array()) {
        if(!Empty($row)){
            $this->setId($row["id"]);
            $this->setChEsMembro($row["chEsMembro"]);
            $this->setChEsMinisterio($row["chEsMinisterio"]);
            $this->setChecked($row["checked"]);
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
    public function getChEsMembro()
    {
        return $this->chEsMembro;
    }

    /**
     * @param mixed $chEsMembro
     */
    public function setChEsMembro($chEsMembro)
    {
        $this->chEsMembro = $chEsMembro;
    }

    /**
     * @return mixed
     */
    public function getChEsMinisterio()
    {
        return $this->chEsMinisterio;
    }

    /**
     * @param mixed $chEsMinisterio
     */
    public function setChEsMinisterio($chEsMinisterio)
    {
        $this->chEsMinisterio = $chEsMinisterio;
    }

    /**
     * @return mixed
     */
    public function getChecked()
    {
        return $this->checked;
    }

    /**
     * @param mixed $checked
     */
    public function setChecked($checked)
    {
        $this->checked = $checked;
    }
}
