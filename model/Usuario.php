<?php

class Usuario {
    public $explicitType = "usuario";
    public $id;
    public $nomeUsuario;
    public $senha;
    public $email;
    public $chEsMembro;
    public $permissoes;
    
    public function __construct($row = array()) {
        $this->setId($row["id"]);
        $this->setNomeUsuario($row["nomeUsuario"]);
        $this->setSenha($row["senha"]);
        $this->setEmail($row["email"]);
        $this->setChEsMembro($row["chEsMembro"]);
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
    public function getNomeUsuario()
    {
        return $this->nomeUsuario;
    }

    /**
     * @param mixed $nomeUsuario
     */
    public function setNomeUsuario($nomeUsuario)
    {
        $this->nomeUsuario = $nomeUsuario;
    }
    
    /**
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }
    
    /**
     * @param mixed $senha
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;
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
    public function getPermissoes()
    {
        return $this->permissoes;
    }

    /**
     * @param mixed $permissoes
     */
    public function setPermissoes($permissoes)
    {
        $this->permissoes = $permissoes;
    }

}