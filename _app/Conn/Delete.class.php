<?php

/**
 * Created by PhpStorm.
 * User: jeyzi
 * Date: 17/09/2016
 * Time: 12:00
 */
class Delete extends Conn
{
    private $Tabela;
    private $Termos;
    private $Places;
    private $Delete;
    private $Conn;
    private $Result;


    public function ExeDelete($Tabela, $Termos, $ParseString){
        $this->Tabela = (string) $Tabela;
        $this->Termos = (string) $Termos;
        parse_str($ParseString, $this->Places);
        $this->getSyntax();
        $this->Execute();

    }

    public function setPlaces($ParseString){
        parse_str($ParseString, $this->Places);
        $this->getSyntax();
        $this->Execute();

    }

    public function getResult(){
        return $this->Result;
    }



    //METODOS PRIVADOS
    private function getSyntax(){
        $this->Delete = "DELETE FROM {$this->Tabela} {$this->Termos}";

    }

    private function Connect(){
        $this->Conn = parent::getConn();
        $this->Delete = $this->Conn->prepare($this->Delete);
    }

    private function Execute(){
        $this->Connect();
        try{
            $this->Delete->execute($this->Places);
            $this->Result = true;

        }catch (PDOException $e){
            $this->Result = null;
            echo "erro ao ler ao Deletar {$e->getMessage()}";


        }
    }



}