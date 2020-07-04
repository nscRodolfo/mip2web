<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MIP-Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/login.css" />
    <!-- Favicons -->
    <link href="img/Imagem1.png" rel="icon">

    <script src="js/bootstrap.js"></script>
    <script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>

</head>

<body>
    <div class="wrapper">
        <div class="formulario">
            <img src="Imagem/Imagem1.png"> </img>

            <form action="confirmaLogin.php" method="POST">
                <p>Email</p>
                <input class="form-control" type="text" name="email" placeholder="Ex: seunome@gmail.com"> </input>
                <br>
                <p>Senha</p>
                <input  class="form-control" type="password" name="senha"  placeholder="******"> </input>
                <br>
                <a href="#"> Esqueci minha senha </a>
                <input type="submit" value="Entrar" class="btn btn-success" id="botao"></input>
            </form>
        </div>
    </div>

</body>

</html>