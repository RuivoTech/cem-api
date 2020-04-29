<?php 

class VisitanteDao {
    
    public function inserir(Visitante $visitante){
        $valores = array(
            $visitante->getNome(),
            $visitante->getEmail(),
            $visitante->getTelefone(),
            $visitante->getCelular(),
            $visitante->getCep(),
            $visitante->getLogradouro(),
            $visitante->getComplemento(),
            $visitante->getVisita(),
            $visitante->getDataVisita(),
            $visitante->getReligiao()
        );
        
        $sql = vsprintf("INSERT INTO 
                            visitante 
                        SET 
                            nome = '%s', 
                            email = '%s',
                            telefone = '%s',
                            celular = '%s',
                            cep = '%s',
                            logradouro = '%s',
                            complemento = '%s',
                            visita = %s, 
                            dataVisita = '%s',
                            religiao = '%s'", $valores);
        echo $sql;
        Conexao::executarUpdate($sql);
        
        $visitante->setId(Conexao::obterId());
        
        return $visitante;
    }
    
    public function alterar(Visitante $visitante) {
        $valores = array(
            $visitante->getId(),
            $visitante->getNome(),
            $visitante->getEmail(),
            $visitante->getTelefone(),
            $visitante->getCelular(),
            $visitante->getCep(),
            $visitante->getLogradouro(),
            $visitante->getComplemento(),
            $visitante->getVisita(),
            $visitante->getDataVisita(),
            $visitante->getReligiao(),
            $visitante->getId()
        );
        
        $sql = vsprintf("UPDATE 
                            visitante 
                        SET 
                            id = %s, 
                            nome = '%s', 
                            email = '%s',
                            telefone = '%s',
                            celular = '%s',
                            cep = '%s',
                            logradouro = '%s',
                            complemento = '%s',
                            visita = %s, 
                            dataVisita = '%s',
                            religiao = '%s'
                        WHERE 
                            id = %s", $valores);
        
        Conexao::executarUpdate($sql);
        
        return $visitante;
    }
    
    public function localizar($id) {
        $sql = "SELECT * FROM visitante WHERE id = $id";
        
        $result = Conexao::executarQuery($sql);
        
        $visitante = new Visitante();
        
        if($result != null){
            $visitante = new Visitante($result[0]);
        }
        
        return $visitante;
    }
    
    public function listar(){
        
        $sql = "SELECT
                    id,
                    nome,
                    email,
                    telefone,
                    celular,
                    cep,
                    logradouro,
                    complemento,
                    dataVisita,
                    religiao,
                    visita
                FROM
                    visitante
                ORDER BY nome ASC";
        
        $result = Conexao::executarQuery($sql);
        
        $dadosRetorno = array();
        for ($i = 0; $i < count($result); $i++) {
            $visitante = new Visitante($result[$i]);
            
            $dadosRetorno[] = $visitante;
        }
        
        return $dadosRetorno;
    }
    
    public function remover($id) {
        $sql = "DELETE FROM visitante WHERE id = $id";
        
        if(Conexao::executarQuery($sql)){
            throw new Exception("Erro, n�o foi poss�vel remover este visitante!", 500);
        }
        
        return "OK";
    }
}