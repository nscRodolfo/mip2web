<?php

    $dsn = "mysql:host=localhost;dbname=bwigvzqu_mip;charset=utf8";

    $usuario = "bwigvzqu_mip";

    $senha = "Mip123456";


    try{
        $PDO = new PDO($dsn, $usuario, $senha);
    }catch(PDOException $erro){
        echo $erro;
    }

?>