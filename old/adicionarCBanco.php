<?php

echo" <script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
";
include 'culturas.php';

session_start();
$conexao = mysqli_connect('127.0.0.1', 'root', '', 'desenvolvimento') or die ("Falha na conexão com o banco de dados!");

$id = $_SESSION['id'];
$codPlanta = $_POST['Cod_Planta'];
$prop = $_GET['idPropriedade'];

$sql = "select * from cultura where fk_Propriedade_Cod_Propriedade = $prop and fk_Planta_Cod_Planta = $codPlanta";
$verifica = mysqli_query($conexao, $sql);

if(mysqli_num_rows($verifica)==1){
    echo "<script> swal('Cultura já existente na propriedade!');
    setTimeout(proximaPagina,2000);
    
    function proximaPagina(){
        window.location = 'culturas.php?idPropriedade=$prop';
    }
                        
    </script>";
}else{
    $sql2 = "insert into cultura (fk_Propriedade_Cod_Propriedade, fk_Planta_Cod_Planta) VALUES ('$prop', '$codPlanta')";
    $result2 = mysqli_query($conexao,$sql2);
    echo "<script> swal('Cultura adicionada com sucesso!');
    setTimeout(proximaPagina,2000);
    
    function proximaPagina(){
        window.location = 'culturas.php?idPropriedade=$prop';
    }
                        
    </script>";
}
?>
