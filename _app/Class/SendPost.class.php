<?php

class SendPost
{
  private $Data;
  private $Msg;
  private $Result;
  private $Id;

  const Entity = 'jg_form';


  //recupera os dados do formulario e o filta e executa
  public function ExeCreate(array $Data)
  {
    $this->Data = $Data;
    $this->CheckData();
    if ($this->Result):
      $this->Create();
    endif;

  }

  public function ExeUpdate(array $Data, $id){
      $this->Data = $Data;
      $this->Id = (int) $id;
      $this->CheckData();
      if($this->Result):
          $this->Update();
      endif;

  }

  public function ExeDelete($id){
      $this->Id = (int) $id;
      $read = new Read;
      $read->ExeRead(self::Entity,"WHERE id = :id","id={$this->Id}");
      if(!$read->getResult()):
         $this->Msg = "<p>O post que você tentou deletar não existe no sistema!</p>";
      else:
          $this->Delete();
          if($this->Result):
             $this->Msg = "<p>Usuario {$read->getResult()[0]['name']} foi deletado com sucesso</p>";
          else:
             $this->Msg = "<p>Erro ao deletar o post volte mais tarde!!</p>";
          endif;
      endif;

  }





  //retorna o resultado
  public function getResult()
  {
    return $this->Result;
  }

  //retorna a messagem
  public function getMsg()
  {
    return $this->Msg;
  }

  //VALIDA O FORMULARIO
  private function CheckData()
  {
    $this->Data = array_map('strip_tags', $this->Data);
    $this->Data = array_map('trim',$this->Data);

    if(in_array('', $this->Data)):
      $this->Result = false;
      $this->Msg = "<p><b>Preencha todos os campos</b>Para se cadastrar preencha todos os campos</p>";
    elseif(!Check::Email($this->Data['email'])) :
      $this->Result = false;
      $this->Msg = "<p><b>Email Invalido</b>Para se cadastrar Informe um Email Válido</p>";
    elseif(!Check::Data($this->Data['date'])):
      $this->Result = false;
      $this->Msg = "<p><b>Data Invalida</b>Para se cadastrar Informe uma Data Válida</p>";
    else:
      $this->Data['date'] = Check::Data($this->Data['date']);
      $this->Result = true;
    endif;


  }


  //cria o post no banco de dados
  private function Create()
  {
    $Create = new Create;
       $Create->ExeCreate(self::Entity, $this->Data);
       if ($Create->getResult()):
           $this->Result = $Create->getResult();
           $this->Msg = "<p><b>Cadastrado com sucesso</b>A Tarefa {$this->Data['name']} foi Cadastrada com sucesso</p>";
      else:
            $this->Msg = "<p><b>Erro ao Cadastrar</b>Erro no sistema Volte mais Tarde</p>";
      endif;
  }

  //atualiza o posto no banco
   private function Update(){
       $Update = new Update();
       $Update->ExeUpdate(self::Entity,$this->Data,"WHERE id = :id","id={$this->Id}");
       if($Update->getResult()):
           $this->Msg = "<p><b>Editado com sucesso</b>A Tarefa {$this->Data['name']} foi Editada com sucesso</p>";
       else:
           $this->Msg = "<p><b>Erro ao Editar</b>Erro no sistema Volte mais Tarde</p>";
       endif;

   }

   private function Delete(){
       $Delete = new Delete();
       $Delete->ExeDelete(self::Entity,"Where id = :id","id={$this->Id}");
       if($Delete->getResult()):
          $this->Result = true;
       else:
           $this->Result = null;
       endif;
   }





}
