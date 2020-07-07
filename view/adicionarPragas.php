<?php
session_start();
if (!isset($_SESSION['logado']) == TRUE) {
  unset($_SESSION['logado']);
  unset($_SESSION['email']);
  unset($_SESSION['nome']);
  unset($_SESSION['id']);
  header('location: login.php');
}
$sessionID = $_SESSION['id'];
$codCultura = $_GET['idCultura'];

$conexao = mysqli_connect('127.0.0.1', 'root', '', 'desenvolvimento') or die("Falha na conexão com o banco de dados!");
$sql = "select Cod_Praga, Nome from praga";
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

            <label>Selecione uma praga </label>
            <select name="Cod_Praga" class="form-control">
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
    $(document).ready(function() {
      $('#btnAdicionarPraga').click(function() {
        if ($.trim($('#senha').val()) == '') {
          swal("Oops", "Por favor, preencha todos os campos", "warning")
        } else if (!(IsEmail(email))) {
          swal("Oops", "Digite um email válido", "warning")
        } else {
          var dados = $('#formAdicionarPraga').serializeArray();
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