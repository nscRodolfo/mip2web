<?php

echo" <script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
";
include 'propriedades.php';

session_start();
$conexao = mysqli_connect('127.0.0.1', 'root', '', 'desenvolvimento') or die ("Falha na conexão com o banco de dados!");
//$selecionaBD = mysqli_select_db('mip', $conexao) or die ("Não foi possível encontrar a base de dados");

$idPropriedade = $_GET['idPropriedade'];

$sql = "DELETE from propriedade WHERE Cod_Propriedade ='$idPropriedade'";

    $result = mysqli_query($conexao, $sql);

    echo "<script> swal('Propriedade excluída com sucesso!');
    setTimeout(proximaPagina,2000);
    
    function proximaPagina(){
        window.location = 'propriedades.php';
    }
                        
    </script>";
?>