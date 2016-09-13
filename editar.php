<html lang="PT-BR">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="_app/css/style.css">
    </head>
    <body>

    <?php
        require('_app/Config.inc.php');
        $id = filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);

        if(!$id){
            header("LOCATION: index.php");
            die;
        }

        $read = new Read;
        $read->ExeRead('jg_form',"WHERE id = :id","id={$id}");
        if($read->getRowCount() >= 1):
            foreach ($read->getResult() as $Form):
                $nome = $Form['name'];
                $email = $Form['email'];
                $date = $Form['date'];
            endforeach;
        else:
            echo "Não existem tarefas cadastradas";
            die;
        endif;

        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);



    ?>

    <form method="post">
        <label>
            <span>Nome</span>
            <input type="text" name="name" value="<?= (isset($data) ? $data['name'] : $nome);?>" />
        </label>

        <label>
            <span>Email</span>
            <input type="email" name="email" value="<?= (isset($data) ? $data['email'] : $email);?>" />
        </label>


        <label>
            <span>Email</span>
            <input type="text" name="date" value="<?= (isset($data) ? $data['date'] : $date);?>" />
        </label>


        <input type="submit" name="sendFormulario" value="Enviar" />







    </form>



    </body>

</html>