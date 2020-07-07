<?php
include "conexao.php";
$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM Usuario WHERE email = '$email'";
$stmt = $PDO->query($sql);
$response_array = null;
$result = $stmt->fetch();

if ($result != null) {
    if ($result['Senha'] == md5($senha)) {
        $response_array['message'] = "Login efetuado com sucesso";
        $response_array['status'] = 1; 
        session_start();
        $_SESSION['logado'] =  TRUE;
        $_SESSION['email'] = $email;
        $_SESSION['nome'] = $result['Nome'];
        $_SESSION['id'] = $result['Cod_Usuario'];
        $_SESSION['tel'] = $result['Telefone'];
    } else {
        $response_array['message'] = "Senha incorreta";
        $response_array['status'] = 2;
    }
} else {
    $response_array['message'] = "Email inválido";
    $response_array['status'] = 3;
}

echo json_encode($response_array);