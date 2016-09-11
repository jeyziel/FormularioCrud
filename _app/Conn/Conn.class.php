<?php

Abstract class Conn
{
  private static $Host = HOST;
  private static $User = USER;
  private static $Pass = PASS;
  private static $Dbsa = DBSA;

  /**PDO**/
  private static $Connect = null;





  /**
  * CONECTA COM O BANCO DE DADOS COM O PADRÃO SIGLETON
  */
  private static function Conectar()
  {

    try
    {
      if(self::$Connect == null):
        $dns = 'mysql:host=' . self::$Host . ';dbname=' . self::$Dbsa ;
        $options = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'];
        self::$Connect = new pdo($dns, self::$User, self::$Pass, $options);
      endif;
    }
    catch(PDOException $e)
    {
      echo "Erro ao estabelecer Conexao com a base de dados {$e->getMessage()}";
    }

    self::$Connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return self::$Connect;

  }

  /**RETORNA A CONEXAO NO PADRÃO SIGLETON*/

  public static function getConn()
  {
    return self::Conectar();
  }










}
