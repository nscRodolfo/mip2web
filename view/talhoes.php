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
$codPlanta = $_GET['codPlanta'];
$codPropriedade = $_GET['codPropriedade'];

//lista os talhoes de certa cultura

$conexao = mysqli_connect('127.0.0.1', 'root', '', 'desenvolvimento') or die("Falha na conexão com o banco de dados!");
$sql = " select Talhao.Nome as name, Cod_Talhao as cod
from talhao, planta, propriedade
JOIN cultura where planta.Cod_Planta = cultura.fk_Planta_Cod_Planta 
and cultura.Cod_Cultura = $codCultura
and cultura.fk_Planta_Cod_Planta = $codPlanta
and cultura.fk_Planta_Cod_Planta = planta.Cod_Planta
and propriedade.Cod_Propriedade = $codPropriedade
and cultura.fk_Propriedade_Cod_Propriedade = propriedade.Cod_Propriedade
and talhao.fk_Cultura_Cod_Cultura = cultura.Cod_Cultura
and talhao.fk_Planta_Cod_Planta = planta.Cod_Planta";



$result = mysqli_query($conexao, $sql);

$result2 = mysqli_query($conexao, " select * from propriedade where propriedade.Cod_Propriedade = $codPropriedade");

$result3 = mysqli_query($conexao, " select * from planta where planta.Cod_Planta = $codPlanta");

$Propriedade = mysqli_fetch_array($result2);
$Planta = mysqli_fetch_array($result3);

?>



<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <link href="../assets/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">

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
          <h5>Talhões - <?php echo $Planta['Nome']; ?> / <?php echo $Propriedade['Nome']; ?>

          </h5>
          <hr size=7>
        </div>
        <section id="dados">
          <div class="row">
            <?php


            while ($tupla = mysqli_fetch_array($result)) {
              echo '
                
               <div class="col-md-4">
                
               <a href="Pragas.php?CodPropriedade=' . $codPropriedade . '&CodPlanta=' . $codPlanta . '&CodTalhao=' . $tupla['cod'] . '&CodCultura=' . $codCultura . '" id="card_a"><div class="card">
                  <div class="titulo">
                    <h5>
                     ' . $tupla['name'] . '
                    </h5>
                    
                  </div>
                  <div class = "informacoes">
                <br>
                  </div>
                </div></a>
               </div>
               
               ';
            }
            ?>
          </div>
        </section>
        <!--                 // <a href="excluirTalhao.php?CodTalhao=' . $tupla['cod'] . '" class="btn btn-secondary bec" >Excluir</a> -->




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


  <!-- Scripts -->


  <!-- Bootstrap core JavaScript -->
  <script src="../assets/lib/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script src="../assets/js/browser.min.js"></script>
  <script src="../assets/js/breakpoints.min.js"></script>
  <script src="../assets/js/transition.js"></script>
  <script src="../assets/js/owl-carousel.js"></script>
  <script src="../assets/js/custom.js"></script>
 

</html>