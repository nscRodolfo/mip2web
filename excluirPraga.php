<?php

echo" <script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
";
include 'Pragas.php';

session_start();
$conexao = mysqli_connect('127.0.0.1', 'root', '', 'desenvolvimento') or die ("Falha na conexão com o banco de dados!");
//$selecionaBD = mysqli_select_db('mip', $conexao) or die ("Não foi possível encontrar a base de dados");

$idCultura = $_GET['idCultura'];
$idPraga = $_GET['idPraga'];

$sql = "DELETE from presencapraga WHERE fk_Praga_Cod_Praga ='$idPraga' and  fk_Cultura_Cod_Cultura = $idCultura";

    $result = mysqli_query($conexao, $sql);

    echo "<script> swal('Praga excluída com sucesso!');
    setTimeout(proximaPagina,2000);
    
    function proximaPagina(){
        window.location = 'Pragas.php?idCultura=$idCultura';
    }
                        
    </script>";
?>


