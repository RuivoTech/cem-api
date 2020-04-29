<?php 

class ContatoDao {
    
    public function inserir(Contato $contato){
        
        $valores = array(
            $contato->getEmail(),
            $contato->getTelefone(),
            $contato->getCelular()
        );
        
        $sql = vsprintf("INSERT INTO contato SET email = '%s', telefone = '%s', celular = '%s'", $valores);
        
        Conexao::executarUpdate($sql);
        
        $contato->setId(Conexao::obterId());

        return $contato;
    }
    
    public function alterar(Contato $contato) {
        $valores = array(
            $contato->getId(),
            $contato->getEmail(),
            $contato->getTelefone(),
            $contato->getCelular(),
            $contato->getId()
        );
        
        $sql = vsprintf("UPDATE contato SET id = %s, email = '%s', telefone = '%s', celular = '%s' WHERE id = %s", $valores);
        
        Conexao::executarUpdate($sql);
        
        return $contato;
    }
    
}