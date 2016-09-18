<?php

require('_app/Config.inc.php');

$id = filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);

$Delete =  new SendPost();
$Delete->ExeDelete($id);

if(!$Delete->getResult()):
    echo $Delete->getMsg();
else:
    echo $Delete->getMsg();
    header("LOCATION: index.php");
endif;

