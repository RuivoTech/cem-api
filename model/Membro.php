<?php

class Membro {
    
    public $explicitType = "membro";
    public $id;
    public $nome;
    public $rg;
    public $dataNascimento;
    public $idade;
    public $sexo;
    public $profissao;
    public $estadoCivil;
    public $chEsConjuge;
    public $conjuge;
    public $ativo;
    public $contato;
    public $endereco;
    public $dadosIgreja;
    public $chEsContato;
    public $chEsEndereco;
    public $chEsIgreja;
    
    public function __construct($row = array()){
        if(!empty($row)){
            $this->setId($row["id"]);
            $this->setNome($row["nome"]);
            $this->setRg($row["rg"]);
            $this->setDataNascimento($row["dataNascimento"]);
            $this->setIdade($row["idade"]);
            $this->setSexo($row["sexo"]);
            $this->setProfissao($row["profissao"]);
            $this->setEstadoCivil($row["estadoCivil"]);
            $this->setChEsConjuge($row["chEsConjuge"]);
            $this->setConjuge($row["conjuge"]);
            $this->setAtivo($row["ativo"]);
            $this->setChEsContato($row["chEsContato"]);
            $this->setChEsEndereco($row["chEsEndereco"]);
            $this->setChEsIgreja($row["chEsIgreja"]);
            
            $this->setContato(new Contato($row));
            $this->setEndereco(new Endereco($row));
            $this->setDadosIgreja(new DadosIgreja($row));
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
    public function getRg()
    {
        return $this->rg;
    }

    /**
     * @param mixed $rg
     */
    public function setRg($rg)
    {
        $this->rg = $rg;
    }

    /**
     * @return mixed
     */
    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }

    /**
     * @param mixed $dataNascimento
     */
    public function setDataNascimento($dataNascimento)
    {
        $this->dataNascimento = $dataNascimento;
    }
    
    /**
     * @return mixed
     */
    public function getIdade()
    {
        return $this->idade;
    }
    
    /**
     * @param mixed $idade
     */
    public function setIdade($idade)
    {
        $this->idade = $idade;
    }

    /**
     * @return mixed
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * @param mixed $sexo
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

    /**
     * @return mixed
     */
    public function getProfissao()
    {
        return $this->profissao;
    }

    /**
     * @param mixed $profissao
     */
    public function setProfissao($profissao)
    {
        $this->profissao = $profissao;
    }

    /**
     * @return mixed
     */
    public function getEstadoCivil()
    {
        return $this->estadoCivil;
    }

    /**
     * @param mixed $estadoCivil
     */
    public function setEstadoCivil($estadoCivil)
    {
        $this->estadoCivil = $estadoCivil;
    }

    /**
     * @return mixed
     */
    public function getChEsConjuge()
    {
        return $this->chEsConjuge;
    }

    /**
     * @param mixed $chEsConjuge
     */
    public function setConjuge($conjuge)
    {
        $this->conjuge = $conjuge;
    }
    
    /**
     * @return mixed
     */
    public function getConjuge()
    {
        return $this->conjuge;
    }
    
    /**
     * @param mixed $chEsConjuge
     */
    public function setChEsConjuge($chEsConjuge)
    {
        $this->chEsConjuge = $chEsConjuge;
    }

    /**
     * @return mixed
     */
    public function getAtivo()
    {
        return $this->ativo;
    }

    /**
     * @param mixed $ativo
     */
    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;
    }

    /**
     * @return mixed
     */
    public function getContato()
    {
        return $this->contato;
    }

    /**
     * @param mixed $contato
     */
    public function setContato($contato)
    {
        $this->contato = $contato;
    }

    /**
     * @return mixed
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * @param mixed $endereco
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }
    
    /**
     * @return mixed
     */
    public function getDadosIgreja()
    {
        return $this->dadosIgreja;
    }
    
    /**
     * @param mixed $dadosIgreja
     */
    public function setDadosIgreja($dadosIgreja)
    {
        $this->dadosIgreja = $dadosIgreja;
    }

    /**
     * @return mixed
     */
    public function getChEsContato()
    {
        return $this->chEsContato;
    }

    /**
     * @param mixed $chEsContato
     */
    public function setChEsContato($chEsContato)
    {
        $this->chEsContato = $chEsContato;
    }

    /**
     * @return mixed
     */
    public function getChEsEndereco()
    {
        return $this->chEsEndereco;
    }

    /**
     * @param mixed $chEsEndereco
     */
    public function setChEsEndereco($chEsEndereco)
    {
        $this->chEsEndereco = $chEsEndereco;
    }
    
    /**
     * @return mixed
     */
    public function getChEsIgreja()
    {
        return $this->chEsIgreja;
    }
    
    /**
     * @param mixed $chEsDadosIgreja
     */
    public function setChEsIgreja($chEsIgreja)
    {
        $this->chEsIgreja = $chEsIgreja;
    }

}

