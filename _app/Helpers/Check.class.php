<?php

class Check
{
  private static $Data;
  private static $Format;

  public static function Email($Email)
  {
    self::$Data = (string) $Email;
    self::$Format = '/^[a-z0-9_\.\-]+@[a-z0-9_\.\-]+\.[a-z]{2,4}$/';

    if(preg_match(self::$Format, self::$Data)):
      return true;
    else:
      return false;
    endif;

  }

  public static function Data($Data)
  {
    self::$Data = $Data;
    self::$Format = '/^([0-9]{2})\/([0-12]{2})\/([0-9]{4})$/';

    if(preg_match(self::$Format, self::$Data)):

      self::$Data = explode('/', self::$Data);
      if(checkdate(self::$Data[1], self::$Data[0], self::$Data[2])):
        self::$Data = self::$Data[2] . '-' . self::$Data[1] . '-' . self::$Data[0];

        return self::$Data;
      else:
        return false;
      endif;

    else:
      return false;
    endif;

  }

  public static function TraduzData($Data)
  {
      self::$Data = $Data;
      self::$Format = explode('-', self::$Data);
      self::$Data = self::$Format[2] . "/" . self::$Format[1] . "/" . self::$Format[0] ;

      return self::$Data;


  }



  }
