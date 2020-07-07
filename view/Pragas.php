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
$codTalhao = 17; #a praga é no talhão né?
$conexao = mysqli_connect('localhost', 'root', '', 'desenvolvimento') or die("Falha na conexão com o banco de dados!");
$sql = "select *
    from praga
    JOIN presencapraga where praga.Cod_Praga = presencapraga.fk_Praga_Cod_Praga
    and presencapraga.fk_Talhao_Cod_Talhao = $codTalhao;";


$result = mysqli_query($conexao, $sql);

$result2 = mysqli_query($conexao, "select planta.Nome, planta.NomeCientifico, propriedade.Nome as NomeP from  planta
join cultura 
join propriedade where cultura.fk_Propriedade_Cod_Propriedade = propriedade.Cod_Propriedade
and planta.Cod_Planta = cultura.fk_Planta_Cod_Planta
and cultura.Cod_Cultura = $codCultura");

$Cultura = mysqli_fetch_array($result2);

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
  <link href="../assets/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
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
          <h5>Pragas - <?php echo '' . $Cultura['Nome'] . ' - ' . $Cultura['NomeP'] . '' ?>
          </h5>
          <hr size=7>
        </div>

        <section id="dados">
          <div class="row">
            <?php
            while ($tupla = mysqli_fetch_array($result)) {
              echo '
                
               <div class="col-md-4">
               <div class="card">
                  <div class="titulo">
                    <h5>
                     ' . $tupla['Nome'] . '
                    </h5>
                    
                  </div>
                  <div class = "informacoes">
                  <span style="color: #659251;">
                  Nome Científico: ' . $tupla['NomeCientifico'] . '
                </span>
                <br>
                <a href="excluirPraga.php?idPraga=' . $tupla['Cod_Praga'] . '&&idCultura=' . $codCultura . '  "class="btn btn-secondary bec" >Excluir</a>
                  </div>
                </div>
               </div>
               
               ';
            }
            ?>
          </div>
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

        <?php
        echo '<a href="adicionarPragas.php?idCultura=' . $codCultura . '" class="float">
<i class="fa fa-plus my-float"></i>
</a>'
        ?>
        <!-- Footer -->
        <footer id="footer">
          <p class="copyright">Copyright &copy; 2019 AgroeComp
            <br>Desenvolvido por <a rel="nofollow" href="">Rodolfo Chagas</a></p>
        </footer>

      </div>
    </div>

  </div>

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script src="../lib/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script src="../assets/js/browser.min.js"></script>
  <script src="../assets/js/breakpoints.min.js"></script>
  <script src="../assets/js/transition.js"></script>
  <script src="../assets/js/owl-carousel.js"></script>
  <script src="../assets/js/custom.js"></script>
</body>


</body>

</html>