<?php 

class DadosIgrejaDao {
    
    public function inserir(DadosIgreja $dadosIgreja){
        
        $valores = array(
            $dadosIgreja->getIsBatizado(),
            $dadosIgreja->getdataBatismo(),
            $dadosIgreja->getIgrejaBatizado(),
            $dadosIgreja->getUltimoPastor(),
            $dadosIgreja->getUltimaIgreja()
        );
        
        $sql = vsprintf("INSERT INTO 
                            dadosIgreja 
                        SET 
                            isBatizado= '%s',
                            dataBatismo = '%s', 
                            igrejaBatizado = '%s',
                            ultimoPastor = '%s',
                            ultimaIgreja = '%s'
                            ", $valores);
        
        Conexao::executarUpdate($sql);
        
        $dadosIgreja->setId(Conexao::obterId());

        return $dadosIgreja;
    }
    
    public function alterar(DadosIgreja $dadosIgreja) {
        $valores = array(
            $dadosIgreja->getId(),
            $dadosIgreja->getIsBatizado(),
            $dadosIgreja->getdataBatismo(),
            $dadosIgreja->getIgrejaBatizado(),
            $dadosIgreja->getUltimoPastor(),
            $dadosIgreja->getUltimaIgreja(),
            $dadosIgreja->getId()
        );
        
        $sql = vsprintf("UPDATE 
                            dadosIgreja 
                        SET 
                            id = %s,
                            isBatizado= '%s',
                            dataBatismo = '%s', 
                            igrejaBatizado = '%s',
                            ultimoPastor = '%s',
                            ultimaIgreja = '%s'
                        WHERE id = %s", $valores);
        
        Conexao::executarUpdate($sql);
        
        return $dadosIgreja;
    }
    
}