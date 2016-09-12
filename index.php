<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="_app/css/style.css">
    <title></title>
  </head>
  <body>
    <?php
    require('_app/config.inc.php');

    $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);


    if(!empty($data['sendForm'])):
      unset($data['sendForm']);
      $Cadastra = new SendPost();
      $Cadastra->ExeCreate($data);

      if(!$Cadastra->getResult()):
        echo $Cadastra->getMsg();
      else:
          echo $Cadastra->getMsg();
          
      endif;

    endif;

      //var_dump($data);

    $read = new Read;
    $read->ExeRead('jg_form',"WHERE id > :id LIMIT :limit",'id=0&limit=5');

    var_dump($read);

    echo 'eae';






    ?>

     <form name="formulario" action="" enctype="multipart/form-data" method="post">
       <label>
         <span>Nome</span>
         <input type="text" name="name" value="<?= $data['name']; ?>" />
       </label>

       <label>
         <span>Email</span>
         <input type="email" name="email"  value="<?= $data['email']; ?>" placeholder="Informe seu email" />
       </label>

       <label>
         <span>Data</span>
         <input type="text" value="<?= $data['date']; ?>" name="date" placeholder="Informe A data padrão DD/MM/MMMM" />
       </label>

       <input type="submit" name="sendForm" value="Enviar" />


     </form>

     <table>
       <tr>
         <th>Nome</th>
         <th>Email</th>
         <th>Data</th>
         <th>Açoes</th>
       </tr>

       <tr>
         <td>Nome</td>
         <td>EMAIL</td>
         <td>DATA</td>
         <td>
           <a href="editar.php">Editar</a>
           <a href="deletar.php">Remover</a>
         </td>

       </tr>

     </table>



  </body>
</html>
