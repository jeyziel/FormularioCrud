<?php


class Read extends Conn
{
	private $Read;
    private $Select;
	private $Places;
	private $Tabela;

    /** @var  PDO */
	private $Conn;
	
	
	public function ExeRead($Tabela,$Termos = null, $ParseString = null)
	{
		$this->Tabela = $Tabela;
		if(!empty($ParseString)):
			parse_str($ParseString, $this->Places);
		endif;
		
		$this->Select = "SELECT * FROM {$Tabela} {$Termos}";
		
		
	}


	//Obtem pdo e prepara a query
    private function Connect()
    {
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($this->Select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
    }



	
	//cria a sintaxe da query para prepared statements
	private function getSyntax()
	{
		if($this->Places):
			foreach($this->Places as $Vinculo => $Valor):
                $this->Read->bindValue(":{$Vinculo}", $Valor, (is_int($Valor)));
			endforeach;
		endif;
	}


	private function Execute()
    {
        $this->Connect();
        try{
            
        }catch(PDOException $e){
            
        }

    }




	
	
	
	
	
	
	
	
	
	
	
}