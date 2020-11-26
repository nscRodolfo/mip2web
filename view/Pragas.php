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
$codTalhao = $_GET['CodTalhao']; #a praga é no talhão né?
$codCultura = $_GET['CodCultura']; #a praga é no talhão né?
$codPlanta = $_GET['CodPlanta'];
$codPropriedade = $_GET['CodPropriedade'];

$conexao = mysqli_connect('localhost', 'bwigvzqu_mip', 'Mip123456', 'bwigvzqu_mip') or die("Falha na conexão com o banco de dados!");
mysqli_set_charset($conexao, "utf8");
$sql = "select *
    from Praga
    JOIN PresencaPraga where Praga.Cod_Praga = PresencaPraga.fk_Praga_Cod_Praga
    and PresencaPraga.fk_Talhao_Cod_Talhao = $codTalhao;";


$result = mysqli_query($conexao, $sql);

// $result2 = mysqli_query($conexao, "select planta.Nome, planta.NomeCientifico, propriedade.Nome as NomeP from  planta
// join cultura 
// join propriedade where cultura.fk_Propriedade_Cod_Propriedade = propriedade.Cod_Propriedade
// and planta.Cod_Planta = cultura.fk_Planta_Cod_Planta
// and cultura.Cod_Cultura = $codCultura");


$result2 = mysqli_query($conexao, " select * from Talhao where Talhao.Cod_Talhao = $codTalhao");
$Talhao = mysqli_fetch_array($result2);

$result3 = mysqli_query($conexao, " select * from Planta where Planta.Cod_Planta = $codPlanta");
$Planta = mysqli_fetch_array($result3);

$result4 = mysqli_query($conexao, " select * from Propriedade where Propriedade.Cod_Propriedade = $codPropriedade");
$Propriedade = mysqli_fetch_array($result4);

?>



<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="with=device-width, initial-scale=1, shrink-to-fit=no">
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
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.21/b-1.6.2/b-flash-1.6.2/b-html5-1.6.2/b-print-1.6.2/r-2.2.5/datatables.min.css" />



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
          <!-- pragas talhao x / Berinjela / fazenda gado novo -->
          <h5>Pragas - <?php echo $Talhao['Nome']; ?> de <?php echo $Planta['Nome'] ?> / <?php echo $Propriedade['Nome']; ?>
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
                <br>
                <a href="#" class="btn btn-secondary bec" onClick="showDiv(\'' . $tupla['Nome'] . '\' , \'' . $tupla['Cod_Praga'] . '\');">
                Gerar relatórios
                </a>
                <a href="excluirPraga.php?idPraga=' . $tupla['Cod_PresencaPraga'] . '&CodTalhao=' . $codTalhao . '&CodCultura=' . $codCultura . '" class="btn btn-danger bec" >Excluir</a>
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

        <?php
        echo '<a href="adicionarPragas.php?codPropriedade=' . $codPropriedade . '&codPlanta=' . $codPlanta . '&codTalhao=' . $codTalhao . '&codCultura=' . $codCultura . '" class="float">
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
  <!-- modal relatorios -->
  <div class="modal fade" id="modalRelatorios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="vertical-align: center" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <ul class="list-group">
            <a href="#" class="list-group-item list-group-item-action" id="graficoPragaContagem">População de pragas por contagem</a> <!-- resgataDadosGraphPlantasPlanos.php -->
            <a href="#" class="list-group-item list-group-item-action" id="graficoPragaAplicacao">População de pragas por aplicação</a> <!-- resgataDadosGraphAplicacao.php -->
            <a href="#" class="list-group-item list-group-item-action" id="listaPdfExcelPlanos">Planos de amostragem realizadas</a> <!-- resgataDadosGraphPlantasPlanos.php -->
            <a href="#" class="list-group-item list-group-item-action" id="listaPdfExcelAplicacoes">Aplicações realizadas</a> <!-- resgataDadosGraphAplicacao.php -->
          </ul>
        </div>
      </div>
    </div>
  </div>

  <div style="overflow-y: auto" class="modal fade" id="modalGraficoPragaContagem" tabindex="-1" role="dialog" aria-labelledby="modalGraficoPragaContagemLabel" aria-hidden="true">
    <div style="overflow-y: auto" class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalGraficoPragaContagemLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <canvas id="chartGraficoContagem"></canvas>

        </div>
      </div>
    </div>
  </div>

  <div style="overflow-y: auto" class="modal fade" id="modalGraficoPragaAplicacao" tabindex="-1" role="dialog" aria-labelledby="modalGraficoPragaAplicacaoLabel" aria-hidden="true">
    <div style="overflow-y: auto" class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalGraficoPragaAplicacaoLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <canvas id="chartGraficoAplicacao"></canvas>

        </div>
      </div>
    </div>
  </div>

  <div style="overflow-y: auto" class="modal fade" id="modalPdfExcelPlanos" tabindex="-1" role="dialog" aria-labelledby="modalPdfExcelPlanosLabel" aria-hidden="true">
    <div style="overflow-y: auto" class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalPdfExcelPlanosLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table id="tabelaPlanos" class="display">

          </table>
        </div>
      </div>
    </div>
  </div>

  <div style="overflow-y: auto" class="modal fade" id="modalPdfExcelAplicacoes" tabindex="-1" role="dialog" aria-labelledby="modalPdfExcelAplicacoesLabel" aria-hidden="true">
    <div style="overflow-y: auto" class="modal-dialog modal-lg " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalPdfExcelAplicacoesLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table id="tabelaAplicacoes" class="display">
        </div>
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
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.21/b-1.6.2/b-flash-1.6.2/b-html5-1.6.2/b-print-1.6.2/r-2.2.5/datatables.min.js"></script>

  <script>
    // $Cod_Talhao = $_GET['Cod_Talhao'];
    // $Cod_Praga = $_GET['Cod_Praga'];
    var codTalhao = <?php echo $codTalhao ?>;
    var codPraga; //vai vir na hora que chama a função
    var nomePraga;
    var nomePlanta = "<?php echo $Planta['Nome']; ?>";

    function showDiv(res_nomePraga, res_codPraga) {
      codPraga = res_codPraga;
      nomePraga = res_nomePraga;
      // alert("cod praga eh " + codPraga);
      $('#modalRelatorios').modal('show');
      $('#exampleModalLabel').text('MIP² | Relatórios <?php echo $Planta['Nome']; ?>: <?php echo $Talhao['Nome'] ?>');
      $('#modalGraficoPragaContagemLabel').text('MIP² | Relatório <?php echo $Planta['Nome']; ?>' + " x " + nomePraga);
      $('#modalGraficoPragaAplicacaoLabel').text('MIP² | Relatório <?php echo $Planta['Nome']; ?>' + " x " + nomePraga);

    }

    $('#graficoPragaContagem').click(function() {
      $.ajax({
        type: "GET",
        url: "../apis/resgataDadosGraphPlantasPlanos.php",
        data: {
          "Cod_Talhao": codTalhao,
          "Cod_Praga": codPraga
        },
        success: function(result) {
          dados = JSON.parse(result);
          console.log(dados);
          //verificar se -> existe dados[0]['Data'])
          $('#modalRelatorios').modal('hide');
          $('#modalGraficoPragaContagem').modal('show');
          $('#modalGraficoPragaContagemLabel').text('MIP² | ' + nomePlanta + " x " + nomePraga);
          let datas = [];
          let pop_pragas = [];
          //prepara os dados de entrada do gráfico
          for (var key in dados) {
            dataE = (dados[key].Data).split("-")
            datex = dataE[2] + "/" + dataE[1] + "/" + dataE[0];
            datas.push(datex);
            pop_pragas.push(dados[key].popPragas);
          }

          var ctx = document.getElementById('chartGraficoContagem').getContext('2d');
          var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
              labels: [...datas],
              datasets: [{
                label: 'População de pragas',
                backgroundColor: 'rgb(101, 146, 81)',
                borderColor: 'rgb(94, 130, 78)',
                data: pop_pragas
              }]
            },

            // Configuration options go here
            options: {}
          });
        },
        error: function() {
          //
        }
      });
      return false;
    });


    $('#graficoPragaAplicacao').click(function() {
      $.ajax({
        type: "GET",
        url: "../apis/resgataDadosGraphAplicacao.php",
        data: {
          "Cod_Talhao": codTalhao,
          "Cod_Praga": codPraga
        },
        success: function(result) {
          dados = JSON.parse(result);

          //verificar se -> existe dados[0]['Data'])
          $('#modalRelatorios').modal('hide');
          $('#modalGraficoPragaAplicacao').modal('show');

          let datas = [];
          let pop_pragas = [];
          //prepara os dados de entrada do gráfico
          for (var key in dados) {
            dataE = (dados[key].DataAplicacao).split("-")
            datex = dataE[2] + "/" + dataE[1] + "/" + dataE[0];
            datas.push(datex);
            pop_pragas.push(dados[key].popPragas);
          }

          var ctx = document.getElementById('chartGraficoAplicacao').getContext('2d');
          var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',
            // The data for our dataset
            data: {
              labels: [...datas],
              datasets: [{
                label: 'População de pragas',
                backgroundColor: 'rgb(101, 146, 81)',
                borderColor: 'rgb(94, 130, 78)',
                data: pop_pragas
              }]
            },

            // Configuration options go here
            options: {}
          });
        },
        error: function() {
          //
        }
      });
      return false;
    });

    $(document).ready(function() {
      $('#listaPdfExcelPlanos').click(function() {
        $.ajax({
          type: "GET",
          url: "../apis/resgataDadosGraphPlantasPlanos.php",
          data: {
            "Cod_Talhao": codTalhao,
            "Cod_Praga": codPraga
          },
          success: function(result) {
            var dados = JSON.parse(result);
            console.log(dados);

            var dadosLocal = [];
            var dadosGeral = [];
            for (var key in dados) {
              var dadosLocal = [];
              var dataE = (dados[key].Data).split("-")
              var datex = dataE[2] + "/" + dataE[1] + "/" + dataE[0];
              dadosLocal.push(datex);
              var autor = dados[key].Autor;
              dadosLocal.push(autor);
              var popPragas = dados[key].popPragas;
              dadosLocal.push(popPragas);
              var numPlantas = dados[key].numPlantas;
              dadosLocal.push(numPlantas);
              var cultura = "<?php echo $Planta['Nome'] ?>";
              dadosLocal.push(cultura);
              var talhao = "<?php echo $Talhao['Nome'] ?>";
              dadosLocal.push(talhao);
              dadosGeral.push(dadosLocal);
            }
            // alert(dadosGeral);
            var dataSet = dadosGeral;

            //Lista o Autor, Cultura, Talhão, Data do plano, plantas infestadas, número de amostras
            dados = JSON.parse(result);
            $('#modalRelatorios').modal('hide');
            $('#modalPdfExcelPlanos').modal('show');

            $('#tabelaPlanos').DataTable({
              destroy: true,
              dom: 'Bfrtip',
              buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
              ],
              responsive: true,
              data: dataSet,
              columns: [{
                  title: "Data"
                },
                {
                  title: "Autor"
                },
                {
                  title: "Pop. pragas"
                },
                {
                  title: "Num. plantas"
                },
                {
                  title: "Cultura",
                  visible: false
                },
                {
                  title: "Talhão",
                  visible:false
                }
              ]
            });
            //gera o datatable
          },
          error: function() {
            //
          }
        });
        return false;
      });
    });

    $(document).ready(function() {
      $('#listaPdfExcelAplicacoes').click(function() {
        $.ajax({
          type: "GET",
          url: "../apis/resgataDadosGraphAplicacao.php",
          data: {
            "Cod_Talhao": codTalhao,
            "Cod_Praga": codPraga
          },
          success: function(result) {
            var dados = JSON.parse(result);
            console.log(dados);
            // alert(dados);
            //Lista o Autor, Cultura, Talhão, Método Aplicado, 
            //Data da aplicação, plantas infestadas, número de amostras
            var dadosLocal = [];
            var dadosGeral = [];
            for (var key in dados) {
              var dadosLocal = [];
              var dataE = (dados[key].DataAplicacao).split("-")
              var dataAplicacao = dataE[2] + "/" + dataE[1] + "/" + dataE[0];
              dadosLocal.push(dataAplicacao);

              var autor = dados[key].Autor;
              dadosLocal.push(autor);

              var cultura = "<?php echo $Planta['Nome'] ?>";
              dadosLocal.push(cultura);

              var talhao = "<?php echo $Talhao['Nome'] ?>";
              dadosLocal.push(talhao);

              var metodo = dados[key].Metodo;
              dadosLocal.push(metodo);


              var numAmostras = dados[key].popPragas;
              dadosLocal.push(numAmostras);

              var numPlantas = dados[key].numPlantas;
              dadosLocal.push(numPlantas);
            
              dadosGeral.push(dadosLocal);
            }
            // alert(dadosGeral);
            var dataSet = dadosGeral;

            //Lista o Autor, Cultura, Talhão, Data do plano, plantas infestadas, número de amostras
            dados = JSON.parse(result);
            $('#modalRelatorios').modal('hide');
            $('#modalPdfExcelAplicacoes').modal('show');

            $('#tabelaAplicacoes').DataTable({
              destroy: true,
              dom: 'Bfrtip',
              buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
              ],
              responsive: true,
              data: dataSet,
              columns: [{
                  title: "Data"
                },
                {
                  title: "Autor"
                },
                {
                  title: "Cultura",
                  visible: false
                },
                {
                  title: "Talhão",
                  visible: false
                },
                {
                  title: "Método"
                },
                {
                  title: "Plantas infestadas"
                },
                {
                  title: "Num. de amostras"
                }
              ]
            });
            //gera o datatable
          },
          error: function() {
            //
          }
        });
        return false;
      });
    });
  </script>

</html>