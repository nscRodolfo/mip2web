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
  $sessionID = $_SESSION['id'];
  $codPropriedade = $_GET['idPropriedade'];

$conexao = mysqli_connect('127.0.0.1', 'root', '', 'desenvolvimento') or die ("Falha na conexão com o banco de dados!");
$sql = "select Cod_Planta, Nome from planta";
$result = mysqli_query($conexao,$sql);

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
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/poslogin-style.css">
    <link rel="stylesheet" href="assets/css/owl.css">

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
  <h5>   Adicionar Cultura
</h5>
<hr size = 7>
</div>




<section id="adicionar">
<?php
echo'<form name="adicionarCultura" method="POST" action="adicionarCBanco.php?idPropriedade='.$codPropriedade.'">'
?>
  <label>Selecione uma cultura </label>
  <select name="Cod_Planta">
    <option>Selecione...</option>
    <?php while($cult = mysqli_fetch_array($result)) { ?>
    <option value="<?php echo $cult['Cod_Planta'] ?>"><?php echo $cult['Nome'] ?></option>
    <?php } ?>
  </select>
  <br>
  <br>
            <input type="submit" value="Adicionar" class="btn btn-success" id="botao">
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

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/browser.min.js"></script>
    <script src="assets/js/breakpoints.min.js"></script>
    <script src="assets/js/transition.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/custom.js"></script>
</body>


  </body>

</html>