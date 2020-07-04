<?php
echo'<head> <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
</head>
';
include 'login.php';

session_start();
$conexao = mysqli_connect('127.0.0.1', 'root', '', 'desenvolvimento') or die ("Falha na conexão com o banco de dados!");
//$selecionaBD = mysqli_select_db('mip', $conexao) or die ("Não foi possível encontrar a base de dados");
$email = $_POST['email'];
$senha= md5($_POST['senha']);
$sql = "select * from usuario where Email = '$email' and Senha = '$senha'";
$result = mysqli_query($conexao, $sql);

$aux = mysqli_fetch_array($result); 

if(mysqli_num_rows($result) > 0)
{
    $_SESSION['logado'] =  TRUE;
    $_SESSION['email'] = $email;
    $_SESSION['nome'] = $aux['Nome'];
    $_SESSION['id'] = $aux['Cod_Usuario'];
    $_SESSION['tel'] = $aux['Telefone'];
    header('Location: propriedades.php');
}
else
{   
    echo "<script> Swal.fire({
        icon: 'error',
        title: 'Ops...',
        text: 'Usuário não existe!'
        }) </script>";
}
?>
