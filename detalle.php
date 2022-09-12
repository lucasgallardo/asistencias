<?php 
include_once 'back/conexion.php';
include 'back/util.php';
is_logued();

include 'back/socios.php';
include 'back/pagos.php';
$id = $_GET['id'];
$datos = datos_socio($id, $conexion);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Octopus - socio</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

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
                    <!-- -->
                    <br>
                    <br>
                    <div class="card shadow" style="width: 100%;">
                      <div class="card-header">
                        <h3>Detalles de socio <strong><?php echo $datos['name'].' '.$datos['lastname']; ?></strong></h3>
                      </div>
                      <div class="card-body">
                          <h5 class="card-title"><strong><?php echo $datos['name'].' '.$datos['lastname']; echo ' - N° de socio: '.$datos['id']; ?></strong></h5>
                          <div class="row">
                            <div class="col">
                              <p class="card-text"><strong>Fecha de inicio:</strong> <?php echo mi_fecha($datos['created_at']); ?></p>
                              <p class="card-text"><strong>DNI:</strong> <?php echo $datos['dni'] ?></p>
                              <p class="card-text"><strong>Edad:</strong> <?php echo $datos['age'] ?></p>
                              <p class="card-text"><strong>Sexo:</strong> <?php echo $datos['sex'] ?></p>
                              <p class="card-text"><strong>Obra social:</strong> <?php echo $datos['prepaid'] ?></p>
                            </div>
                            <div class="col">
                              <p class="card-text"><strong>Firmó:</strong> <?php echo $datos['sign'] ?></p>
                              <p class="card-text"><strong>Turno:</strong> <?php echo $datos['hour'] ?></p>
                              <p class="card-text"><strong>Tipo:</strong> <?php echo $datos['type'] ?></p>
                              <p class="card-text"><strong>Teléfono:</strong> <?php echo $datos['phone'] ?></p>
                              <p class="card-text"><strong>Email:</strong> <?php echo $datos['email'] ?></p>
                            </div>
                          </div>
                          
                          <hr>
                          
                          <a href="index.php" class="card-link">Volver al listado</a>
                          <!-- <a href="#" class="card-link">Another link</a> -->
                      </div>
                    </div>
                  <br>
                  <a href="#" data-toggle="modal" data-target="#addPayment">
                      <button class="btn btn-primary">
                        <i class="fas fa-fw fa-plus"></i>
                        Cargar pago
                      </button>
                  </a>   
                  <br>
                  <?php any_message(); ?>
                  <br>
                  <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" id="historialPagos" class="btn btn-secondary" onclick="historial_pagos(<?php echo $id; ?>);">Historial de pagos</button>
                    <button type="button" id="historialAsistencias" class="btn btn-secondary" onclick="historial_asistencia(<?php echo $id; ?>);">Historial de asistencias</button>
                    <a href="editar_socio.php?id=<?php echo $id; ?>">
                      <button type="button" class="btn btn-outline-secondary">Editar información</button>
                    </a>
                  </div>
                  <br>

                  <div id="info"></div>

                  <br>
                  <hr>
                  
                  <a class="card-link" href="#" data-toggle="modal" data-target="#eliminarCliente">
                    <button class="btn btn-danger">
                      <i class="fas fa-trash fa-sm fa-fw mr-2 text-gray-400"></i>
                      Borrar cliente
                    </button>
                  </a>


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

    <div class="modal fade" id="addPayment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cargar pago</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>

                <div class="modal-body">
                  <form action="back/pagos.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="titulo">Tipo</label>
                            <select class="select custom-select mb-3" name="tipo">
                              <option value="mensual" selected>Mensual</option>
                              <option value="diario">Diario</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="monto">Monto</label>
                            <input type="text" class="form-control" id="monto" name="monto" aria-describedby="tituloHelp" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="fecha">Fecha</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <div class="col-sm-6">
                            <label for="fecha">Tipo de pago</label>
                            <select class="select custom-select mb-3" name="tipoPago">
                              <option value="efectivo" selected>Efectivo</option>
                              <option value="mercadopago">Mercado Pago</option>
                              <option value="debito">Débito</option>
                              <option value="credito">Crédito</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="fecha">Recobro</label>
                            <input type="number" class="form-control" id="recobro" name="recobro">
                        </div>
                        <div class="col-sm-6">
                          <?php if(moroso($datos['id'], $conexion)){ ?>
                            <div class="alert alert-danger" role="alert">
                              Socio moroso
                            </div>
                          <?php } ?>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $datos['id']; ?>">
                    <button class="btn btn-primary btn-user btn-block" type="submit" name="agregar">
                      Guardar
                    </button>
                  </form>
                </div>
              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
              </div>
            </div>
          </div>
     </div>

     <!-- eliminar cliente -->
     <div class="modal fade" id="eliminarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">¿Borrar cliente?</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                      </button>
                  </div>
                  <div class="modal-body">¿Confirma que desear borrrar el cliente?
                    <p>Esta acción no se podrá deshacer</p>
                  </div>
                  <div class="modal-footer">
                      <?php $_SESSION['id_cliente'] = $id; ?>
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                      <a class="btn btn-danger" href="back/borrar_cliente.php">Borrar</a>
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
    <!-- <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script> -->

    <script>
      function historial_pagos(id){
        $('#info').load('back/historial/pagos_historial.php?id='+id);
      }
      function historial_asistencia(id){
        $('#info').load('back/historial/asistencia_historial.php?id='+id);
      }
    </script>
    <!-- JavaScript -->

    <script src="js/functions.js"></script>


</body>

</html>