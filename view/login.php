<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MIP-Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="../css/login.css" />
    <!-- Favicons -->
    <link href="../assets/img/logo-agroecomp.png" rel="icon">

    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body>
    <div class="wrapper">
        <div class="formulario">
            <img src="../assets/img/logo-agroecomp.png"> </img>

            <form id="formLogin">
                <p>Email</p>
                <input class="form-control" type="text" name="email" id="email" placeholder="Ex: seunome@gmail.com" required> </input>
                <br>
                <p>Senha</p>
                <input class="form-control" type="password" name="senha" id="senha" placeholder="******" required autocomplete="off"> </input>
                <br>
                <a href="#"> Esqueci minha senha </a>
                <input type="submit" value="Entrar" class="btn btn-success" id="btnLogin"></input>
            </form>
        </div>
    </div>

    <script>
        //cadastro e edição de casos


        $(document).ready(function() {

            function IsEmail(email) {
                var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if (!regex.test(email)) {
                    return false;
                } else {
                    return true;
                }
            }

            $('#btnLogin').click(function() {
                var email = $('#email').val();

                if ($.trim($('#senha').val()) == '' || $.trim($('#email').val()) == '') {
                    swal("Oops", "Por favor, preencha todos os campos", "warning")
                } else if (!(IsEmail(email))) {
                    swal("Oops", "Digite um email válido", "warning")
                } else {
                    var dados = $('#formLogin').serializeArray();
                    $.ajax({
                        type: "POST",
                        url: "../apis/EntrarSite.php",
                        data: dados,
                        success: function(result) {
                            alert(result);
                            var resultado = JSON.parse(result);
                            var status = resultado['status'];
                            var message = resultado['message'];
                            if (status == 1) {
                                swal("Tudo certo", message, "success");
                                window.location.href = "../view/propriedades.php"; 
                            } else if (status == 2) {
                                swal("Oops", message, "error");
                            } else if (status == 3) {
                                swal("Oops", message, "error");
                            }
                        },
                        error: function() {
                            swal("Oops", "Erro ao processar requisição!", "error");
                        }
                    });
                }
                return false;
            });
        });
    </script>
</body>

</html>