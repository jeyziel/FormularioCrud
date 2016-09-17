<?php

/**
 * Created by PhpStorm.
 * User: jeyzi
 * Date: 16/09/2016
 * Time: 21:47
 */
class Update extends Conn
{
    private $Tabela;
    private $Dados;
    private $Termos;
    private $Places;
    private $Result;
    private $Update;
    private $Conn;

    public function ExeUpdate($Tabela,array $Dados, $Termos, $ParseString){
        $this->Tabela = (string) $Tabela;
        $this->Dados = $Dados;
        $this->Termos = $Termos;

        parse_str($ParseString, $this->Places);
        $this->Execute();

    }

    public function getResult(){
        return $this->Result;
    }

    public function getRowCount(){
        return $this->Conn->getRowCount();
    }

    public function setPlaces($ParseString){
        parse_str($ParseString, $this->Places);
        $this->Execute();

    }


    //METODOS PRIVADOS

    private function Connect(){
        $this->Conn = parent::getConn();
        $this->Update = $this->Conn->prepare($this->Update);
    }

    private function getSyntax(){
        foreach ($this->Dados as $Key => $Value):
            $Places[] = $Key . ' = :' . $Key;
        endforeach;
        $Places = implode(', ',$Places);
        $this->Update = "UPDATE {$this->Tabela} SET {$Places} {$this->Termos}";
    }

    private function Execute(){
        $this->getSyntax();
        $this->Connect();
        try{

            $this->Update->execute(array_merge($this->Dados,$this->Places));
            $this->Result = true;


        }catch (PDOException $e){
            $this->Result =  null;
            echo "erro ao atualizar informaçoes no banco {$e->getMessage()}";

        }
    }











}