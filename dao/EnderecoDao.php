<?php 

class EnderecoDao {
    
    public function inserir(Endereco $endereco){
        
        $valores = array(
            $endereco->getCep(),
            $endereco->getCidade(),
            $endereco->getEstado(),
            $endereco->getLogradouro(),
            $endereco->getComplemento()
        );
        
        $sql = vsprintf("INSERT INTO 
                            endereco 
                        SET 
                            cep= '%s',
                            cidade = '%s', 
                            estado = '%s',
                            logradouro = '%s',
                            complemento = '%s'
                            ", $valores);
        
        Conexao::executarUpdate($sql);
        
        $endereco->setId(Conexao::obterId());
        
        return $endereco;
    }
    
    public function alterar(Endereco $endereco) {
        $valores = array(
            $endereco->getId(),
            $endereco->getCep(),
            $endereco->getCidade(),
            $endereco->getEstado(),
            $endereco->getLogradouro(),
            $endereco->getComplemento(),
            $endereco->getId()
        );
        
        $sql = vsprintf("UPDATE 
                            endereco 
                        SET 
                            id = %s, 
                            cep = '%s', 
                            cidade = '%s', 
                            estado = '%s',
                            logradouro = '%s',
                            complemento = '%s'
                        WHERE id = %s", $valores);
        
        Conexao::executarUpdate($sql);
        
        return $endereco;
    }
    
}