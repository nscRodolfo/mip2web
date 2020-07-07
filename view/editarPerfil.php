<?php
session_start();
if (!isset($_SESSION['logado']) == TRUE) {
  unset($_SESSION['logado']);
  unset($_SESSION['email']);
  unset($_SESSION['nome']);
  unset($_SESSION['id']);
  header('location: login.php');
}
$nome = $_SESSION['nome'];
$email = $_SESSION['email'];
$tel = $_SESSION['tel'];
$id = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <link href="../assets/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="icon" href="../assets/img/logo-agroecomp.png">
  <title>Monitoramento Inteligente de Pragas</title>

  <!-- Bootstrap core CSS -->
  <link href="../assets/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">


  <!-- Additional CSS Files -->
  <link rel="stylesheet" href="../assets/css/fontawesome.css">
  <link rel="stylesheet" href="../assets/css/poslogin-style.css">
  <link rel="stylesheet" href="../assets/css/owl.css">

</head>

<body class="is-preload">

  <!-- Wrapper -->
  <div id="wrapper">

    <!-- Main -->
    <div id="main">
      <div class="inner">

        <!-- Header -->
        <header id="header">
          <div class="logo">
            <a>MIP²</a>
          </div>
        </header>
        <div>
          <h5> Editar Perfil
          </h5>
          <hr size=7>
        </div>
        <br>
        <section id="adicionar">
          <form id="formEditarPerfil">
            <table>
              <tr>
                <td>
                <input type="hidden" id="Cod_Usu" name="Cod_Usu" value="<?php echo $id ?>">
                  <h6>Nome do produtor: </h6>
                </td>
                <td> <input type="text" name="Nome" id="nome" class="form-control" value="<?php echo $nome ?>" required>
                  </input> </td>
              </tr>

              <tr>
                <td>
                  <h6>Telefone: </h6>
                </td>
                <td> <input type="text" name="Telefone" id="telefone" class="form-control" value="<?php echo $tel ?>" minlength="10" maxlength="11" required>
                  </input>
                </td>
              </tr>
              <tr>
                <td>
                  <h6>Email: </h6>
                </td>
                <td> <input type="text" name="Email" class="form-control" id="email" value="<?php echo $email ?>" minlength="10" maxlength="11" required>
                  </input>
                </td>
              </tr>

            </table>



            <br>
            <input type="submit" value="Salvar" class="btn btn-success" id="btnEditarPerfil">
            </input>
          </form>
        </section>
      </div>
    </div>

    <!-- Sidebar -->
    <div id="sidebar">

      <div class="inner">

        <!-- Search Box -->
        <section id="search" class="alt">
          <h5>
            <?php
            echo $_SESSION['nome'];
            ?>
          </h5>
        </section>

        <!-- Menu -->
        <nav id="menu">
          <ul>
            <li><a href="perfil.php" class="ativo">Perfil</a></li>
            <li><a href="propriedades.php">Propriedades</a></li>
            <li><a href="relatorios.php">Relatórios</a></li>
            <li>
              <span class="opener">Informações</span>
              <ul>
                <li><a href="infoCulturas.php">Culturas</a></li>
                <li><a href="infoPragas.php">Pragas</a></li>
                <li><a href="infoInimigosNaturais.php">Inimigos Naturais</a></li>
                <li><a href="infoMeControle.php">Métodos de Controle</a></li>
              </ul>
            </li>
          </ul>
        </nav>

        <!-- Footer -->
        <footer id="footer">
          <p class="copyright">Copyright &copy; 2019 AgroeComp
            <br>Desenvolvido por <a rel="nofollow" href="">Rodolfo Chagas</a></p>
        </footer>

      </div>

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

            $('#btnEditarPerfil').click(function() {
                var email = $('#email').val();
                if ($.trim($('#nome').val()) == '' || $.trim($('#telefone').val()) == '' || $.trim($('#email').val()) == '') {
                    swal("Oops", "Por favor, preencha todos os campos", "warning")
                } else if (!(IsEmail(email))) {
                    swal("Oops", "Digite um email válido", "warning")
                } else {
                    var dados = $('#formEditarPerfil').serializeArray();
                    $.ajax({
                        type: "GET",
                        url: "../apis/attInfoPerfil.php",
                        data: dados,
                        success: function(result) {
                          swal("Tudo certo", "Perfil alterado com sucesso!", "success");
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

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script src="../assets/lib/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script src="../assets/js/browser.min.js"></script>
  <script src="../assets/js/breakpoints.min.js"></script>
  <script src="../assets/js/transition.js"></script>
  <script src="../assets/js/owl-carousel.js"></script>
  <script src="../assets/js/custom.js"></script>
</body>


</body>

</html>