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
$codTalhao = $_GET['codTalhao'];
$codCultura = $_GET['codCultura'];
$codPropriedade = $_GET['codPropriedade'];
$codPlanta = $_GET['codPlanta'];
$conexao = mysqli_connect('localhost', 'bwigvzqu_mip', 'Mip123456', 'bwigvzqu_mip') or die("Falha na conexão com o banco de dados!");
mysqli_set_charset($conexao, "utf8");
$sql = "select Cod_Praga, Nome from Praga";
$result = mysqli_query($conexao, $sql);


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

  <!-- Bootstrap core CSS -->
  <link href="../assets/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
          <h5> Adicionar Praga
          </h5>
          <hr size=7>
        </div>




        <section id="adicionar">
          <!--echo '<form name="adicionarPraga" method="POST" action="adicionarPragasBanco.php?idCultura=' . $codCultura . '">' -->
          <form id="formAdicionarPraga">
            <input type="hidden" name="Cod_Talhao" id="Cod_Talhao" value="<?php echo $codTalhao ?>">
            <label>Selecione uma praga </label>
            <select id="Cod_Praga" name="Cod_Praga" class="form-control">
              <option>Selecione...</option>
              <?php while ($prag = mysqli_fetch_array($result)) { ?>
                <option value="<?php echo $prag['Cod_Praga'] ?>"><?php echo $prag['Nome'] ?></option>
              <?php } ?>
            </select>
            <br>
            <br>
            <input type="submit" value="Adicionar" class="btn btn-success" id="btnAdicionarPraga">
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
      $('#btnAdicionarPraga').click(function() {
        if ($.trim($('#Cod_Praga').val()) == '') {
          swal("Oops", "Por favor, preencha todos os campos", "warning")
        } else {
          var dados = $('#formAdicionarPraga').serializeArray();
          $.ajax({
            type: "GET",
            url: "../apis/adicionarPraga.php",
            data: dados,
            success: function(result) {
              swal("Tudo certo", "Praga adicionada com sucesso", "success");
              window.location = 'Pragas.php?CodTalhao=<?php echo $codTalhao?>&CodPlanta=<?php echo $codPlanta?>&CodPropriedade=<?php echo $codPropriedade?>&CodCultura=<?php echo $codCultura?>CodTalhao=<?php echo $codTalhao?>&CodCultura=<?php echo $codCultura?>';
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