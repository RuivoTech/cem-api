<?php

class Permissao {
    public $explicitType = "permissao";
    public $id;
    public $menuPermissao;
    public $grupoMenuPermissao;
    public $chEsUsuario;
    public $chEsMenuPermissao;
    public $permissao;
    
    public function __construct($row = "") {
        if(!Empty($row)){
            $this->setId($row["id"]);
            $this->setMenuPermissao($row["menuPermissao"]);
            $this->setGrupoMenuPermissao($row["grupoMenuPermissao"]);
            $this->setChEsUsuario($row["chEsUsuario"]);
            $this->setChEsMenuPermissao($row["chEsMenuPermissao"]);
            $this->setPermissao($row["permissao"]);
        }else{
            $this->setId(0);
        }
    }
    
    /**
     * @return mixed
     */
    public function getGrupoMenuPermissao()
    {
        return $this->grupoMenuPermissao;
    }

    /**
     * @param mixed $grupoMenuPermissao
     */
    public function setGrupoMenuPermissao($grupoMenuPermissao)
    {
        $this->grupoMenuPermissao = $grupoMenuPermissao;
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
    public function getChEsUsuario()
    {
        return $this->chEsUsuario;
    }

    /**
     * @param mixed $chEsUsuario
     */
    public function setChEsUsuario($chEsUsuario)
    {
        $this->chEsUsuario = $chEsUsuario;
    }

    /**
     * @return mixed
     */
    public function getChEsMenuPermissao()
    {
        return $this->chEsMenuPermissao;
    }

    /**
     * @param mixed $chEsMenu
     */
    public function setChEsMenuPermissao($chEsMenuPermissao)
    {
        $this->chEsMenuPermissao = $chEsMenuPermissao;
    }

    /**
     * @return mixed
     */
    public function getPermissao()
    {
        return $this->permissao;
    }

    /**
     * @param mixed $permissao
     */
    public function setPermissao($permissao)
    {
        $this->permissao = $permissao;
    }
    /**
     * @return mixed
     */
    public function getMenuPermissao()
    {
        return $this->menuPermissao;
    }

    /**
     * @param mixed $menuPermissao
     */
    public function setMenuPermissao($menuPermissao)
    {
        $this->menuPermissao = $menuPermissao;
    }

}

