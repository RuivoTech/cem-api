<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login
 *
 * @author Richieri
 */
class Login {
    public $explicitType = "login";
    public $id;
    public $nomeUsuario;
    public $email;
    public $hash;
    
    public function __construct(array $row) {
        $this->setId($row["id"]);
        $this->setNomeUsuario($row["nomeUsuario"]);
        $this->setEmail($row["email"]);
        $this->setHash($row["hash"]);
    }
    
    function getId() {
        return $this->id;
    }

    function getNomeUsuario() {
        return $this->nomeUsuario;
    }
    
    function getEmail() {
        return $this->email;
    }

    function getHash() {
        return $this->hash;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNomeUsuario($nomeUsuario) {
        $this->nomeUsuario = $nomeUsuario;
    }
    
    function setEmail($email) {
        $this->email = $email;
    }

    function setHash($hash) {
        $this->hash = $hash;
    }


}
