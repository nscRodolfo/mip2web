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

$conexao = mysqli_connect('127.0.0.1', 'root', '', 'desenvolvimento') or die("Falha na conexão com o banco de dados!");
$sql = "select propriedade.Cod_Propriedade, propriedade.Nome, propriedade.Cidade, propriedade.Estado from propriedade
        JOIN produtor 
        JOIN usuario where usuario.Cod_Usuario = produtor.fk_Usuario_Cod_Usuario 
        and produtor.Cod_Produtor = propriedade.fk_Produtor_Cod_Produtor
        and usuario.Cod_Usuario = $sessionID";
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

  <link rel="icon" href="imagem/Imagem1.png">
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
          <h5> Propriedades
          </h5>
          <hr size=7>
        </div>

        <section id="dados">
          <div class="row">

            <?php
            while ($tupla = mysqli_fetch_array($result)) {
              echo '
                
               <div class="col-md-4">

                
               <a href="culturas.php?idPropriedade=' . $tupla['Cod_Propriedade'] . '" id="card_a"><div class="card">
                  <div class="titulo">
                    <h5>
                     ' . $tupla['Nome'] . '
                    </h5>
                  </div>
                  <div class = "informacoes">
                    <span>
                      Cidade: ' . $tupla['Cidade'] . '
                      <br>
                      Estado: ' . $tupla['Estado'] . '
                      <br>
                      <br>
                    </span>
                    <a href="editarPropriedade.php?idPropriedade=' . $tupla['Cod_Propriedade'] . '&&Nome=' . $tupla['Nome'] . '&&Cidade=' . $tupla['Cidade'] . '&&Estado=' . $tupla['Estado'] . '     "class="btn btn-success" id="botao">Editar</a>
                    <a href="excluirPropriedade.php?idPropriedade=' . $tupla['Cod_Propriedade'] . '  "class="btn btn-secondary" id="botaoSair">Excluir</a>
                  </div>
                </div></a>
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
        <section style="vertical-align: text-bottom;" id="search" class="alt">
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


        <a href="adicionarPropriedade.php" class="float">
          <i class="fa fa-plus my-float"></i>
        </a>
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
  <script src="../lib/jquery/jquery.min.js"></script>
  <script src="../lib/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script src="../assets/js/browser.min.js"></script>
  <script src="../assets/js/breakpoints.min.js"></script>
  <script src="../assets/js/transition.js"></script>
  <script src="../assets/js/owl-carousel.js"></script>
  <script src="../assets/js/custom.js"></script>
</body>


</body>

</html>