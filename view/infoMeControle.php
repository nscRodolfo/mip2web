<?php
  session_start();
  if(!isset($_SESSION['logado']) == TRUE)
  {
      unset($_SESSION['logado']); 
      unset($_SESSION['email']);
      unset($_SESSION['nome']);
      unset($_SESSION['id']);
      header('location: login.php');
  }
  $conexao = mysqli_connect('127.0.0.1', 'root', '', 'desenvolvimento') or die ("Falha na conexão com o banco de dados!");
    $sql = "select * from metododecontrole";
$result = mysqli_query($conexao,$sql);
//$aux = mysqli_fetch_array($result); 
?>
<!DOCTYPE html>
<html lang="pt">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">

    <link rel="icon" href="../assets/img/logo-agroecomp.png">
    <title>Monitoramento Inteligente de Pragas</title>

    <script src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
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
  <h5>   Métodos de controle
</h5>
<hr size = 7>
</div>
            <section id="dados">

                 <?php
                    while($fetch = mysqli_fetch_row($result)){
                        echo "<h5>Nome: ".$fetch[1].
                         "<br><br>Materiais necessários: " .$fetch[2].
                         "<br><br>Modo de preparo: " .$fetch[3].
                         "<br><br>Intervalo de aplicação (em dias): " .$fetch[4].
                          "<br><br>Efeitos colaterais: " .$fetch[5]. 
                          "<br><br>Observações: ".$fetch[6].
                          "</h5><hr size = 7><br>";
                    }             
                 ?>
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
                <li><a href="propriedades.php">Propriedades</a></li>
                <li><a href="relatorios.php">Relatórios</a></li>
                <li>
                  <span class="opener">Informações</span>
                  <ul>
                    <li><a href="infoCulturas.php">Culturas</a></li>
                    <li><a href="infoPragas.php">Pragas</a></li>
                    <li><a href="infoInimigosNaturais.php">Inimigos Naturais</a></li>
                    <li><a href="infoMeControle.php"  class="ativo">Métodos de Controle</a></li>
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
</body>


  </body>

</html>
