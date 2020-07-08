<?php
echo'<head> <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
</head>
';

session_start();
$conexao = mysqli_connect('127.0.0.1', 'root', '', 'desenvolvimento') or die ("Falha na conexão com o banco de dados!");
//$selecionaBD = mysqli_select_db('mip', $conexao) or die ("Não foi possível encontrar a base de dados");

$id = $_SESSION['id'];

$sql = "select Cod_Produtor from produtor where fk_Usuario_Cod_Usuario = '$id'";
$result = mysqli_query($conexao, $sql);
$aux = mysqli_fetch_array($result); 

$nomeP = $_POST['nomePropriedade'];

$cidade = $_POST['cidade'];

$estado = $_POST['estado'];

$sql2 = "insert into propriedade (Nome, Cidade, Estado, fk_Produtor_Cod_Produtor)
            VALUES ('$nomeP', '$cidade', '$estado', '$aux[0]')";

$result2 = mysqli_query($conexao,$sql2);

header("location:propriedades.php");

?>
