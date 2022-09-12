<?php 
  include 'back/util.php';
  is_logued();
  // $_SESSION["filtro"] = $row["name"];
  if(isset($_POST['fecha'])){
    $lugar = "";
  }else{
    $lugar = "ingresos";
  }

  include 'back/ingresos.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Octopus - Ingresos</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'back/sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include 'back/topbar.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="jumbotron">
                      <h1 class="display-5">Listado de ingresos
                        <?php 
                          if(isset($_POST['fecha'])){
                            echo "entre ".mi_fecha($_POST['desde'])." y ".mi_fecha($_POST['hasta']);
                            echo '<div class="card-deck">';
                            echo ingresos_por_fecha($conexion, $_POST['desde'], $_POST['hasta']);
                            echo '</div>';
                          }else{
                            $todayHoy = date('d-m-Y');
                            echo "del día $todayHoy";
                            echo '<div class="card-deck">';
                            echo tipo_de_ingresos($conexion);
                            echo '</div>';
                          } 
                        ?>
                      </h1>
                     
                      <hr class="my-4">
                      <div class="col col-lg-4">
                        <h4>Filtrar por rango de fecha:</h4>
                        <form action="" method="POST">
                          <div class="form-row">
                            <div class="col">
                              <input type="date" class="form-control" name="desde" require>
                            </div>
                            <div class="col">
                              <input type="date" class="form-control" name="hasta" require>
                            </div>
                            <div class="col">
                              <button type="submit" class="form-control btn btn-secondary" name="fecha">Buscar</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>

                    <p>
                      <!-- <div>
                        <h4>Filtrar por:</h4>
                        <div class="btn-group" role="group" aria-label="Basic example">
                          <form action="" method="POST">
                            <button type="submit" name="hoy" class="btn btn-secondary">Hoy</button>
                          </form>
                          <form action="" method="POST">
                            <button type="submit" name="semana" class="btn btn-secondary">Semana</button>
                          </form>
                          <form action="" method="POST">
                            <button type="submit" name="mes" class="btn btn-secondary">Mes</button>
                          </form>
                        </div>
                      </div> -->
                      
                    </p>
                    

                    <div class="card shadow mb-4">
                      
                      <div class="card-body">
                        <div class="table-responsive">
                          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                              <tr>
                                <th>N° de socio</th>
                                <th>Fecha</th>
                                <th>Nombre</th>
                                <th>Pago</th>
                                <th>Tipo de pago</th>
                                <th>Ver</th>
                              </tr>
                            </thead>
                            <tfoot>
                              <tr>
                                <th>N° de socio</th>
                                <th>Fecha</th>
                                <th>Nombre</th>
                                <th>Pago</th>
                                <th>Tipo de pago</th>
                                <th>Ver</th>
                              </tr>
                            </tfoot>
                            <tbody>
                              <?php include 'back/socios.php';?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Octopus 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Salir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">¿Confirma que desear cerrar la sesión?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="back/exit.php">Salir</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script>
      $(document).ready(function() {
        $('#dataTable').DataTable(
        {
          dom: 'Bfrtip',
          buttons: [
            'csv', 'excel', 'print'
        ],
          language: {
                processing: "Procesando...",
                search: "Buscar:",
                lengthMenu: "Mostrar _MENU_ registros",
                info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
                infoFiltered: "(filtrado de un total de _MAX_ registros)",
                infoPostFix: "",
                loadingRecords: "Cargando...",
                zeroRecords: "No se encontraron resultados",
                emptyTable: "Ningún dato disponible en esta tabla",
                paginate: {
                    first: "Primero",
                    previous: "Anterior",
                    next: "Siguiente",
                    last: "Último"
                },
                aria: {
                    sortAscending: ": Activar para ordenar la columna de manera ascendente",
                    sortDescending: ": Activar para ordenar la columna de manera descendente"
                }
            }
        } 
        );
    } );
    </script>

    <script src="js/functions.js"></script>

</body>

</html>