<?php

/**
 * Description of DadosIgreja
 *
 * @author Richieri
 */
class DadosIgreja {
    public $explicitType = "dadosIgreja";
    public $id, $isBatizado, $dataBatismo, $igrejaBatizado, $ultimoPastor, $ultimaIgreja, $ministerios;
    
    public function __construct($row) {
        $this->setId($row["id"]);
        $this->setIsBatizado($row["isBatizado"]);
        $this->setDataBatismo($row["dataBatismo"]);
        $this->setIgrejaBatizado($row["igrejaBatizado"]);
        $this->setUltimoPastor($row["ultimoPastor"]);
        $this->setUltimaIgreja($row["ultimaIgreja"]);
    }
    
    public function ehNovo() {
        return !$this->getId() > 0;
    }
    
    function getId() {
        return $this->id;
    }

    function getIsBatizado() {
        return $this->isBatizado;
    }

    function getDataBatismo() {
        return $this->dataBatismo;
    }

    function getIgrejaBatizado() {
        return $this->igrejaBatizado;
    }

    function getUltimoPastor() {
        return $this->ultimoPastor;
    }

    function getUltimaIgreja() {
        return $this->ultimaIgreja;
    }

    function getMinisterios() {
        return $this->ministerios;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIsBatizado($isBatizado) {
        $this->isBatizado = $isBatizado;
    }

    function setDataBatismo($dataBatismo) {
        $this->dataBatismo = $dataBatismo;
    }

    function setIgrejaBatizado($igrejaBatizado) {
        $this->igrejaBatizado = $igrejaBatizado;
    }

    function setUltimoPastor($ultimoPastor) {
        $this->ultimoPastor = $ultimoPastor;
    }

    function setUltimaIgreja($ultimaIgreja) {
        $this->ultimaIgreja = $ultimaIgreja;
    }

    function setMinisterios($ministerios) {
        $this->ministerios = $ministerios;
    }
}
