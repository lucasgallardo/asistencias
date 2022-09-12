<?php 
  include 'back/util.php';
  is_logued();
  include 'back/socios.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Octopus - Nuevo cliente</title>

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
                    <h1 class="h3 mb-4 text-gray-800">Nuevo cliente</h1>
                    <form method="POST" action="back/socios.php">
                        <div class="form-group row">
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <label for="numero">N° de socio</label>
                                <input type="text" class="form-control form-control-user" 
                                       name="numero" 
                                       placeholder="N° de socio"
                                       value="<?php echo siguiente_id($conexion); ?>"
                                       >
                            </div>
                            <div class="col-sm-4">
                                <label for="documento">Documento</label>
                                <input type="text" class="form-control form-control-user" name="documento" placeholder="Documento">
                            </div>
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <label for="numero">Sexo</label>
                                <select class="custom-select custom-select mb-3" name="sexo">
                                    <option value="Hombre" selected>Hombre</option>
                                    <option value="Hombre">Mujer</option>
                                    <option value="Hombre">Otro</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="numero">Nombre</label>
                                <input type="text" class="form-control form-control-user" name="nombre" placeholder="Nombre">
                            </div>
                            <div class="col-sm-6">
                                <label for="documento">Edad</label>
                                <input type="text" class="form-control form-control-user" name="edad" placeholder="edad">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="numero">Adulto/Niño</label>
                                <select class="custom-select custom-select mb-3" name="generacion">
                                    <option value="Adulto">Adulto</option>
                                    <option value="Niño">Niño</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="documento">Obra Social</label>
                                <input type="text" class="form-control form-control-user" name="prepaga" placeholder="Obra Social">
                            </div>
                            <div class="col-sm-3">
                                <label for="documento">Firmó</label>
                                <select class="custom-select custom-select mb-3" name="firmo">
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="numero">Tipo de socio</label>
                                <select class="custom-select custom-select mb-3" name="tipo">
                                    <option value="mensual">Mensual</option>
                                    <option value="diario">Diario</option>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label for="numero">Turno de la cuota</label>
                                <select class="custom-select custom-select mb-3" name="turno">
                                    <option value="Mañana">Mañana</option>
                                    <option value="Tarde">Tarde</option>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label for="documento">Mes de la cuota</label>
                                <input type="date" class="form-control form-control-user" name="fecha" placeholder="fecha" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <div class="col-sm-3">
                                <label for="documento">Monto</label>
                                <input type="text" class="form-control form-control-user" name="monto" placeholder="Monto">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="numero">Teléfono</label>
                                <input type="text" class="form-control form-control-user" name="telefono" placeholder="Teléfono">
                            </div>
                            <div class="col-sm-6">
                                <label for="documento">Correo</label>
                                <input type="text" class="form-control form-control-user" name="correo" placeholder="Correo">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label for="comentarios">Comentarios</label>
                                <textarea class="form-control" id="comentarios" name="comentarios" rows="3"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" name="guardar">Guardar</button>
                    </form>

                    
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

</body>

</html>