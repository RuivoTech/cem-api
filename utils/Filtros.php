<?php

class Filtros {
    public const dataInicio = " MONTH(m.dataNasc) BETWEEN MONTH('%s')";
    public const dataFim = " MONTH('%s')";
    public const aniversariantes = " MONTH(m.dataNasc) = MONTH(CURRENT_DATE())";
    public const ministerio = " mm.chEsMinisterio = %s";
    public const sexo = " m.sexo = %s";
    public const estadoCivil = " m.estadoCivil = %s";
    public const nome = " m.nome LIKE '%%%s%%'";
    
    public static function montarQuery( array $filtros = array() ) {
        $primeiro = true;
        $where = "";
        
        foreach ($filtros as $key => $value) {
            if($primeiro && defined("self::" . $key)){
                $where = " WHERE";
                $primeiro = false;
            }elseif(defined("self::" . $key)){
                $where .= " AND";
            }
            
            $where .= vsprintf(constant("self::" . $key), array($value));
        }
        
        return $where;
    }
}

