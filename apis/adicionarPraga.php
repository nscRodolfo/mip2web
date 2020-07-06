<?php
    include "conexao.php";

    // pega a variavel da url passada no aplicativo android
    $Cod_Praga = $_GET['Cod_Praga'];
    $Cod_Talhao = $_GET['Cod_Talhao'];

    
        $sql2 = "INSERT INTO PresencaPraga(fk_Praga_Cod_Praga, fk_Talhao_Cod_Talhao) VALUES (:CODPRAGA,:CODTALHAO)";

        // prepara o statment
        $stmt = $PDO->prepare($sql2);
        //statment
        $stmt->bindParam(':CODPRAGA',$Cod_Praga);
        $stmt->bindParam(':CODTALHAO',$Cod_Talhao);

        // só executa a query depois de receber os valores
        $stmt->execute();

        $verifica = array("confirmacao" => true);

    echo json_encode($verifica);


?>