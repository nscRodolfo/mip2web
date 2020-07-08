<?php

echo" <script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
";
include 'editarPerfil.php';

session_start();
$conexao = mysqli_connect('127.0.0.1', 'root', '', 'desenvolvimento') or die ("Falha na conexão com o banco de dados!");
//$selecionaBD = mysqli_select_db('mip', $conexao) or die ("Não foi possível encontrar a base de dados");
$email = $_POST['email'];
$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$idUsu = $_SESSION['id'];


$sql = "UPDATE usuario SET Nome='$nome',Telefone=$telefone WHERE Cod_Usuario ='$idUsu'";

    $result = mysqli_query($conexao, $sql);
    $_SESSION['nome'] = $nome;
    $_SESSION['telefone'] = $telefone;



    echo "<script> swal('Usuario editado com sucesso!');
    setTimeout(proximaPagina,2000);
    
    function proximaPagina(){
        window.location = 'Perfil.php';
    }
                        
    </script>";
?>