<?php

class OfertaDao {
    
    public function inserir(Oferta $oferta) {
        $dados = array(
            $oferta->getDataOferta(),
            $oferta->getValorOferta()
        );
        
        $sql = vsprintf("INSERT INTO 
                            ofertas
                        SET 
                            dataOferta = '%s',
                            valorOferta = '%s'", $dados);
        
        Conexao::executarUpdate($sql);
        
        $oferta->setId(Conexao::obterId());
        
        return $oferta;
    }
    
    public function alterar(Oferta $oferta) {
        $dados = array(
            $oferta->getId(),
            $oferta->getDataOferta(),
            $oferta->getValorOferta(),
            $oferta->getId()
        );
        
        $sql = vsprintf("UPDATE
                            ofertas
                        SET
                            id = '%s',
                            dataOferta = '%s',
                            valorOferta = '%s'
                        WHERE
                            id = '%s'", $dados);
        
        Conexao::executarUpdate($sql);
        
        return $oferta;
    }
    
    public function listar() {
        $sql = "SELECT 
                    id,
                    dataOferta,
                    valorOferta
                FROM
                    ofertas
                ORDER BY dataOferta DESC";
        
        $resultado = Conexao::executarQuery($sql);
        
        $retorno = array();
        for ($i = 0; $i < count($resultado); $i++) {
            $oferta = new Oferta($resultado[$i]);
            
            $retorno[] = $oferta;
        }
        
        return $retorno;
    }
    
    public function localizar($id) {
        
        $sql = "SELECT
                    id,
                    dataOferta,
                    valorOferta
                FROM
                    ofertas
                WHERE
                    id = $id";
        
        $resultado = Conexao::executarQuery($sql);
        
        if($resultado == 1){
            $oferta = new Oferta($resultado[0]);
        }
        
        return $oferta;
    }
}

