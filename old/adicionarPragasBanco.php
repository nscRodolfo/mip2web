<?php

echo" <script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
";
include 'Pragas.php';

session_start();
$conexao = mysqli_connect('127.0.0.1', 'root', '', 'desenvolvimento') or die ("Falha na conexão com o banco de dados!");

$id = $_SESSION['id'];
$cult = $_GET['idCultura'];
$codPraga = $_POST['Cod_Praga'];


$sql = "select * from presencapraga where fk_Cultura_Cod_Cultura = $cult and fk_Praga_Cod_Praga = $codPraga";
$verifica = mysqli_query($conexao, $sql);

if(mysqli_num_rows($verifica)==1){
    echo "<script> swal('Praga já existe na cultura!');
    setTimeout(proximaPagina,2000);
    
    function proximaPagina(){
        window.location = 'Pragas.php?idCultura=$cult';
    }
                        
    </script>";
}else{
    $sql2 = "insert into presencapraga (fk_Praga_Cod_Praga, fk_Cultura_Cod_Cultura) VALUES ('$codPraga', '$cult')";
    $result2 = mysqli_query($conexao,$sql2);
    echo "<script> swal('Praga adicionada com sucesso!');
    setTimeout(proximaPagina,2000);
    
    function proximaPagina(){
        window.location = 'Pragas.php?idCultura=$cult';
    }
                        
    </script>";
}




?>
