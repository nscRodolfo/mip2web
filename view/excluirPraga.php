<?php

echo" <script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
";

session_start();
$conexao = mysqli_connect('127.0.0.1', 'root', '', 'desenvolvimento') or die ("Falha na conexão com o banco de dados!");
//$selecionaBD = mysqli_select_db('mip', $conexao) or die ("Não foi possível encontrar a base de dados");

$idPraga = $_GET['idPraga'];
$codTalhao = $_GET['CodTalhao']; #a praga é no talhão né?
$codCultura = $_GET['CodCultura']; 

$sql = "DELETE from presencapraga WHERE Cod_PresencaPraga ='$idPraga'";

    $result = mysqli_query($conexao, $sql);

    echo "<script> swal('Propriedade excluída com sucesso!');
    setTimeout(proximaPagina,2000);
    
    function proximaPagina(){
        window.location = 'Pragas.php?CodTalhao=$codTalhao&CodCultura=$codCultura';
    }</script>"

                   
?>


