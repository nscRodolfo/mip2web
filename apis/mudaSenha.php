<?php
    include "conexao.php";

    $link = ('localhost', 'bwigvzqu_mip', 'Mip123456', 'bwigvzqu_mip');
    mysqli_set_charset($link, "utf8");


    // pega a variavel da url passada no aplicativo android
    $senha = $_GET['Senha'];
    $Cod_Usu = $_GET['Cod_Usu'];

    $sql2 = "UPDATE Usuario SET Senha='$senha'
                WHERE Usuario.Cod_Usuario = '$Cod_Usu'";
    $ex = mysqli_query($link,$sql2); //recebe resultado da query do sql
    $verifica = array("confirmacao" => true);

    echo json_encode($verifica);


?>