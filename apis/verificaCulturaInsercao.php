<?php
    include "conexao.php";

    // pega a variavel da url passada no aplicativo android
    $codPlanta = $_GET['Cod_Planta'];
    $codPropriedade = $_GET['Cod_Propriedade'];

    // seleciona a propriedade

    $sql = "SELECT * FROM Cultura WHERE fk_Propriedade_Cod_Propriedade = '$codPropriedade' 
    AND fk_Planta_Cod_Planta = '$codPlanta'
                   ";
                   //GROUP BY Talhao.Nome
    
    $dados = $PDO->query($sql);
    $resultado = array();

    if($ed = $dados->fetch(PDO::FETCH_OBJ)){
        echo 1;
    }else{
        echo 2;
    } //passa os dados como objetos pro $ed
    
    // echo json_encode($resultado);
   
?>