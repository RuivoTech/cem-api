<?php

class Conexao {
    
    /*
     * Atributo est�tico para inst�ncia do PDO
     */
    private static $pdo;
    
    /*
     * Escondendo o construtor da classe
     */
    private function __construct() {
        //
    }
    
    /*
     * M�todo est�tico para retornar uma conex�o v�lida
     * Verifica se j� existe uma inst�ncia da conex�o, caso n�o, configura uma nova conex�o
     */
    public static function getInstance() {
        if (!isset(self::$pdo)) {
            try {
               // $opcoes = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8', PDO::ATTR_PERSISTENT => TRUE);
                self::$pdo = new PDO("mysql:host=" . HOST . "; dbname=" . DBNAME . "; charset=" . CHARSET . ";", USER, PASSWORD);
            } catch (PDOException $e) {
                error_log("Erro: " . $e->getMessage());
            }
        }
        
        return self::$pdo;
    }
    
    public static function executarUpdate($query){

        $conexao = Conexao::getInstance();
        
        $stmt = $conexao->prepare($query);
        
        if(!$stmt->execute()) {
            throw new Exception($stmt->errorInfo()[2], 500);
        }
    }
    
    public static function executarQuery($query){
        $conexao = Conexao::getInstance();
        
        $stmt = $conexao->prepare($query);
        if(!$stmt->execute()) {
            throw new Exception($stmt->errorInfo()[2], 500);
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function obterId(){
        $conexao = Conexao::getInstance();

        return $conexao->lastInsertId();
    }
}