<?php

class Create extends Conn
{
  private $Tabela;
  private $Dados;
  private $Result;
  private $Insert;

  /** @var PDOStatement  * */
  private $Create;

  private $Conn;

  public function ExeCreate($Tabela, array $Dados)
  {
    $this->Tabela = (string) $Tabela;
    $this->Dados = $Dados;
    $this->getSyntax();
    $this->Execute();


  }

  public function getResult()
  {
    return $this->Result;
  }



  //METODOS PRIVADOS


  /** cria a syntax da query */
  private function getSyntax()
  {
    $Fileds = implode(', ', array_keys($this->Dados));
    $Places = ':' . implode(', :',array_keys($this->Dados));
    $this->Insert = "INSERT INTO {$this->Tabela} ({$Fileds}) VALUES ({$Places})";
  }

  //recebe a conexao e prepara a query
  private function Connect()
  {
    $this->Conn = parent::getConn();
    $this->Create = $this->Conn->prepare($this->Insert);
  }


  //executa a query

  private function Execute()
  {
    $this->Connect();
    try
    {
      $this->Create->execute($this->Dados);
      $this->Result = $this->Conn->lastInsertId();
    }
    catch(PDOException $e)
    {
      $this->Result = null;
      print("Erro ao Cadastrar {$e->getMessage()}");
    }

  }















}
