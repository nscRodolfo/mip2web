<?php

    $dsn = "mysql:host=localhost;dbname=desenvolvimento;charset=utf8";

    $usuario = "root";

    $senha = "";


    try{
        $PDO = new PDO($dsn, $usuario, $senha);
    }catch(PDOException $erro){
        echo $erro;
    }

?>