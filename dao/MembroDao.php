<?php

class MembroDao {
    
    public function inserir(Membro $membro){
        if(empty($membro)){
            throw new Exception("Variável dados está vazia!", 500);
        }
        
        $contatoDao = new ContatoDao();
        $enderecoDao = new EnderecoDao();
        $dadosIgrejaDao = new DadosIgrejaDao();
        
        $contato = $contatoDao->inserir($membro->getContato());
        $endereco = $enderecoDao->inserir($membro->getEndereco());
        $dadosIgreja = $dadosIgrejaDao->inserir($membro->getDadosIgreja());
        $ministerioMembroService = new MinisterioMembroService();

        $ministerioMembroService->removerPorMembro($membro->getId());

        for ($i=0; $i < count($membro->getMinisteriosMembro()); $i++) { 
            if($membro->getMinisteriosMembro()[$i]->getChecked()) {
                $ministerioMembroService->salvar($membro->getMinisteriosMembro()[$i]);
            }
        }
        
        $valores = array(
            $membro->getNome(),
            $membro->getRg(),
            $membro->getDataNascimento(),
            $membro->getSexo(),
            $membro->getProfissao(),
            $membro->getEstadoCivil(),
            $membro->getChEsConjuge(),
            $contato->getId(),
            $endereco->getId(),
            $dadosIgreja->getId()
        );
        
        $sql = vsprintf("INSERT INTO 
                            membros
                         SET 
                            nome = '%s',
                            rg = '%s',
                            dataNasc = '%s',
                            sexo = %s,
                            profissao = '%s',
                            estadoCivil = '%s',
                            chEsConjuge = '%s',
                            chEsContato = %s,
                            chEsEndereco = %s,
                            chEsIgreja = %s", $valores);
        
        Conexao::executarUpdate($sql);
        
        $membro->setId(Conexao::ObterId());
        
        return $membro;
    }
    
    public function alterar(Membro $membro){
        if(empty($membro)){
            throw new Exception("Variável dados está vazia!", 500);
        }
        
        $contatoDao = new ContatoDao();
        $enderecoDao = new EnderecoDao();
        $dadosIgrejaDao = new DadosIgrejaDao();
        $ministerioMembroDao = new MinisterioMembroDao();

        $contatoDao->alterar($membro->getContato());
        $enderecoDao->alterar($membro->getEndereco());
        $dadosIgrejaDao->alterar($membro->getDadosIgreja());

        $ministerioMembroDao->removerPorMembro($membro->getId());
        
        for ($i=0; $i < count($membro->getMinisteriosMembro()); $i++) { 
            
            if(boolval($membro->getMinisteriosMembro()[$i]->getChecked())) {
                $ministerioMembroDao->inserir($membro->getMinisteriosMembro()[$i]);
            }
        }
        
        $valores = array(
            $membro->getId(),
            $membro->getNome(),
            $membro->getRg(),
            $membro->getDataNascimento(),
            $membro->getSexo(),
            $membro->getProfissao(),
            $membro->getEstadoCivil(),
            $membro->getChEsConjuge(),
            $membro->getId()
        );
        
        $sql = vsprintf("UPDATE
                            membros
                         SET
                            id = %s,
                            nome = '%s',
                            rg = '%s',
                            dataNasc = '%s',
                            sexo = %s,
                            profissao = '%s',
                            estadoCivil = '%s',
                            chEsConjuge = %s
                        WHERE
                            id = %s", $valores);
        
        Conexao::executarUpdate($sql);
        
        return $membro;
    }
    
    public function listar(){
        
        $sql = "SELECT 
                    m.id,
                    m.nome,
                    m.rg,
                    m.dataNasc AS dataNascimento,
                    TIMESTAMPDIFF(YEAR, m.dataNasc, NOW()) AS idade,
                    m.sexo,
                    m.profissao,
                    m.estadoCivil,
                    m.chEsConjuge,
                    m.ativo,
                    m.chEsContato,
                    m.chEsEndereco,
                    m.chEsIgreja,
                    c.email,
                    c.telefone,
                    c.celular,
                    e.cep,
                    e.cidade,
                    e.estado,
                    e.logradouro,
                    e.complemento,
                    d.isBatizado,
                    d.dataBatismo,
                    d.igrejaBatizado,
                    d.ultimoPastor,
                    d.ultimaIgreja,
                    con.nome as conjuge
                FROM 
                    membros m 
                INNER JOIN 
                    contato c on c.id = m.chEsContato 
                INNER JOIN 
                    endereco e on e.id = m.chEsEndereco
                INNER JOIN
                    dadosIgreja d on d.id = m.chEsIgreja
                LEFT JOIN 
                    membros con ON con.id = m.chEsConjuge
                ORDER BY m.nome ASC";
        
        $result = Conexao::executarQuery($sql);
        
        $dadosRetorno = array();
        for ($i = 0; $i < count($result); $i++) {
            $ministerioMembroDao = new MinisterioMembroDao();
            
            $membro = new Membro($result[$i]);
            
            $ministerios = $ministerioMembroDao->localizarPorMembro($membro->getId());
            
            $membro->getContato()->setId($membro->getChEsContato());
            $membro->getEndereco()->setId($membro->getChEsEndereco());
            $membro->getDadosIgreja()->setId($membro->getChEsIgreja());
            $membro->setMinisteriosMembro($ministerios);
            
            $dadosRetorno[] = $membro;
        }
        
        return $dadosRetorno;
    }
    
    public function listarAniversariante(){
        
        $sql = "SELECT
                    m.id,
                    m.nome,
                    m.rg,
                    m.dataNasc AS dataNascimento,
                    TIMESTAMPDIFF(YEAR, m.dataNasc, NOW()) AS idade,
                    m.sexo,
                    m.profissao,
                    m.estadoCivil,
                    m.chEsConjuge,
                    m.ativo,
                    m.chEsContato,
                    m.chEsEndereco,
                    m.chEsIgreja,
                    c.email,
                    c.telefone,
                    c.celular,
                    e.cep,
                    e.cidade,
                    e.estado,
                    e.logradouro,
                    e.complemento,
                    d.isBatizado,
                    d.dataBatismo,
                    d.igrejaBatizado,
                    d.ultimoPastor,
                    d.ultimaIgreja,
                    con.nome as conjuge
                FROM
                    membros m
                INNER JOIN
                    contato c on c.id = m.chEsContato
                INNER JOIN
                    endereco e on e.id = m.chEsEndereco
                INNER JOIN
                    dadosIgreja d on d.id = m.chEsIgreja
                LEFT JOIN membros con ON con.id = m.chEsConjuge
                WHERE
                    DAY(m.dataNasc) > DAY(now()) AND
                    MONTH(m.dataNasc) >= MONTH(now()) AND
                    MONTH(m.dataNasc) <= MONTH(now() + interval 1 month)
                ORDER BY DAY(m.dataNasc) ASC";
        
        $result = Conexao::executarQuery($sql);
        
        $dadosRetorno = array();
        for ($i = 0; $i < count($result); $i++) {
            
            $membro = new Membro($result[$i]);
            $membro->getContato()->setId($membro->getChEsContato());
            $membro->getEndereco()->setId($membro->getChEsEndereco());
            $membro->getDadosIgreja()->setId($membro->getChEsIgreja());
            
            $dadosRetorno[] = $membro;
        }
        
        return $dadosRetorno;
    }
    
    public function localizar($id){
        
        $sql = "SELECT
                    m.id,
                    m.nome,
                    m.rg,
                    m.dataNasc AS dataNascimento,
                    TIMESTAMPDIFF(YEAR, m.dataNasc, NOW()) AS idade,
                    m.sexo,
                    m.profissao,
                    m.estadoCivil,
                    m.chEsConjuge,
                    m.ativo,
                    m.chEsContato,
                    m.chEsEndereco,
                    m.chEsIgreja,
                    c.email,
                    c.telefone,
                    c.celular,
                    e.cep,
                    e.cidade,
                    e.estado,
                    e.logradouro,
                    e.complemento,
                    d.isBatizado,
                    d.dataBatismo,
                    d.igrejaBatizado,
                    d.ultimoPastor,
                    d.ultimaIgreja,
                    con.nome as conjuge
                FROM
                    membros m
                INNER JOIN
                    contato c on c.id = m.chEsContato
                INNER JOIN
                    endereco e on e.id = m.chEsEndereco
                INNER JOIN
                    dadosIgreja d on d.id = m.chEsIgreja
                LEFT JOIN membros con ON con.id = m.chEsConjuge
                WHERE
                    m.id = " . $id;
        
        $result = Conexao::executarQuery($sql);
        
        $membro = new Membro();
        if(!Empty($result)){
            $ministerioDao = new MinisterioDao();
            
            $membro = new Membro($result[0]);
            
            $ministerios = $ministerioDao->localizarMinisterioPorMembro($membro->getId());
            
            $membro->getContato()->setId($membro->getChEsContato());
            $membro->getEndereco()->setId($membro->getChEsEndereco());
            $membro->getDadosIgreja()->setId($membro->getChEsIgreja());
            $membro->getDadosIgreja()->setMinisterios($ministerios);
        }
        
        return $membro;
    }
    
    public function remover($id) {
        $sql = "DELETE FROM membros WHERE id = $id";
        
        if(Conexao::executarQuery($sql)){
            throw new Exception("Erro, não foi possível remover este usuário!", 500);
        }
        
        return "OK";
    }
    
    public function gerarRelatorio($dados = array()){
        
        $sql = "SELECT
                    m.id,
                    m.nome,
                    m.rg,
                    IF(m.dataNasc, DATE_FORMAT(m.dataNasc, '%d/%m/%Y'), null) AS dataNascimento,
                    TIMESTAMPDIFF(YEAR, m.dataNasc, NOW()) AS idade,
                    m.sexo,
                    m.profissao,
                    m.estadoCivil,
                    m.chEsConjuge,
                    m.ativo,
                    m.chEsContato,
                    m.chEsEndereco,
                    m.chEsIgreja,
                    c.email,
                    c.telefone,
                    c.celular,
                    e.cep,
                    e.cidade,
                    e.estado,
                    e.logradouro,
                    e.complemento,
                    d.isBatizado,
                    d.dataBatismo,
                    d.igrejaBatizado,
                    d.ultimoPastor,
                    d.ultimaIgreja,
                    con.nome as conjuge
                FROM
                    membros m
                INNER JOIN
                    contato c on c.id = m.chEsContato
                INNER JOIN
                    endereco e on e.id = m.chEsEndereco
                INNER JOIN
                    dadosIgreja d on d.id = m.chEsIgreja
                LEFT JOIN
                    membros con ON con.id = m.chEsConjuge
                LEFT JOIN ministerioMembro mm ON mm.chEsMembro = m.id
                LEFT JOIN ministerios min ON min.id = mm.chEsMinisterio";
        
        if($dados["aniversariantes"] == "false"){
            unset($dados["aniversariantes"]);
        }
        
        $sql .= Filtros::montarQuery($dados);
        
        $sql .= " ORDER BY m.nome ASC";
        
        $result = Conexao::executarQuery($sql);
        
        $dadosRetorno = array();
        for ($i = 0; $i < count($result); $i++) {
            
            $membro = new Membro($result[$i]);
            $membro->getContato()->setId($membro->getChEsContato());
            $membro->getEndereco()->setId($membro->getChEsEndereco());
            $membro->getDadosIgreja()->setId($membro->getChEsIgreja());
            
            $dadosRetorno[] = $membro;
        }
        
        return $dadosRetorno;
    }
}

