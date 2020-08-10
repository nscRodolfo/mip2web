<?php
session_start();
if (!isset($_SESSION['logado']) == TRUE) {
  unset($_SESSION['logado']);
  unset($_SESSION['email']);
  unset($_SESSION['nome']);
  unset($_SESSION['id']);
  header('location: https://mip.software/view/login.php');
}
$sessionID = $_SESSION['id'];

$conexao = mysqli_connect('localhost', 'bwigvzqu_mip', 'Mip123456', 'bwigvzqu_mip') or die("Falha na conexão com o banco de dados!");
mysqli_set_charset($conexao, "utf8");
$sql = "select Propriedade.Cod_Propriedade, Propriedade.Nome, Propriedade.Cidade, Propriedade.Estado from Propriedade
        JOIN Produtor 
        JOIN Usuario where Usuario.Cod_Usuario = Produtor.fk_Usuario_Cod_Usuario 
        and Produtor.Cod_Produtor = Propriedade.fk_Produtor_Cod_Produtor
        and Usuario.Cod_Usuario = $sessionID";
$result = mysqli_query($conexao, $sql);

$sql = "select Cod_Produtor from Produtor where fk_Usuario_Cod_Usuario = '$sessionID'";
$result = mysqli_query($conexao, $sql);
$aux = mysqli_fetch_array($result);

?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">

  <link rel="icon" href="../assets/img/logo-agroecomp.png">
  <title>Monitoramento Inteligente de Pragas</title>

  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
          <h5> Adicionar Propriedade
          </h5>
          <hr size=7>
        </div>


        <section id="adicionar">
          <form id="formAdicionarPropriedade">
            <input type="hidden" name="fk_Produtor_Cod_Produtor" value=<?php echo $aux[0]; ?>>
            <table>
              <tr>
                <td>
                  <h6>Nome da propriedade: </h6>
                </td>
                <td> <input type="text" name="Nome" id="nome-propriedade" class="form-control" placeholder="Ex: Fazenda..." required>
                  </input> </td>
              </tr>
              <tr>
                <td>
                  <h6>Cidade: </h6>
                </td>
                <td> <input type="text" name="Cidade" id="cidade" class="form-control" placeholder="Ex: Rio Pomba" required>
                  </input>
                </td>
              </tr>
              <tr>
                <td>
                  <h6>Estado: </h6>
                </td>
                <td> <input type="text" name="Estado" id="estado" class="form-control" placeholder="Ex: MG, SP, RJ ..." maxlength="2" required>
                  </input>
                </td>
              </tr>

            </table>

            <br>
            <input type="submit" value="Salvar" class="btn btn-success" id="btnAdicionarPropriedade">
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
            <li><a href="perfil.php">Perfil</a></li>
            <li><a href="propriedades.php" class="ativo">Propriedades</a></li>
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
    $(document).ready(function() {
      $('#btnAdicionarPropriedade').click(function() {
        setTimeout(() => {

        }, 2000);
        if ($.trim($('#nome-propriedade').val()) == '' || $.trim($('#cidade').val()) == '' || $.trim($('#estado').val()) == '') {
          swal("Oops", "Por favor, preencha todos os campos", "warning")
        } else {
          var dados = $('#formAdicionarPropriedade').serializeArray();
          $.ajax({
            type: "GET",
            url: "../apis/adicionarPropriedade.php",
            data: dados,
            success: function(result) {
              swal("Tudo certo", "Propriedade inserida com sucesso", "success");
              setTimeout(function(){  }, 4000);
              window.location = 'propriedades.php';
            
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