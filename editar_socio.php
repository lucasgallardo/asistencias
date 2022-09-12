<?php 
  include 'back/util.php';
  is_logued();
  include 'back/socios.php';

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

    <title>Octopus - editar socio</title>

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
                    <h1 class="h3 mb-4 text-gray-800">Editar socio</h1>
                    <form method="POST" action="back/socios.php">
                        <div class="form-group row">
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <label for="numero">N° de socio</label>
                                <input type="text" class="form-control form-control-user" 
                                       name="numero" 
                                       placeholder="N° de socio"
                                       value="<?php echo $datos['id']; ?>"
                                       readonly
                                       >
                            </div>
                            <div class="col-sm-4">
                                <label for="documento">Documento</label>
                                <input type="text" class="form-control form-control-user" name="documento" placeholder="Documento" value="<?php echo $datos['dni']; ?>">
                            </div>
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <label for="numero">Sexo</label>
                                <select class="custom-select custom-select mb-3" name="sexo">
                                    <?php echo sexo_combo($datos['sex']); ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-5 mb-3 mb-sm-0">
                                <label for="numero">Nombre</label>
                                <input type="text" class="form-control form-control-user" name="nombre" placeholder="Nombre" value="<?php echo $datos['name']; ?>">
                            </div>
                            <div class="col-sm-5 mb-3 mb-sm-0">
                                <label for="numero">Apellido</label>
                                <input type="text" class="form-control form-control-user" name="apellido" placeholder="Apellido" value="<?php echo $datos['lastname']; ?>">
                            </div>
                            <div class="col-sm-2">
                                <label for="documento">Edad</label>
                                <input type="number" class="form-control form-control-user" name="edad" placeholder="edad" value="<?php echo $datos['age']; ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="numero">Adulto/Niño</label>
                                <select class="custom-select custom-select mb-3" name="generacion">
                                    <?php echo adulto_ninio($datos['generation']); ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="documento">Obra Social</label>
                                <input type="text" class="form-control form-control-user" name="prepaga" placeholder="Obra Social" value="<?php echo $datos['prepaid']; ?>">
                            </div>
                            <div class="col-sm-3">
                                <label for="documento">Firmó</label>
                                <select class="custom-select custom-select mb-3" name="firmo">
                                    <?php echo firmo($datos['sign']); ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="numero">Tipo de socio</label>
                                <select class="custom-select custom-select mb-3" name="tipo">
                                    <?php echo tipo($datos['type']); ?>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label for="numero">Turno de la cuota</label>
                                <select class="custom-select custom-select mb-3" name="turno">
                                    <?php echo turno($datos['hour']); ?>
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
                                <input type="text" class="form-control form-control-user" name="telefono" placeholder="Teléfono" value="<?php echo $datos['phone']; ?>">
                            </div>
                            <div class="col-sm-6">
                                <label for="documento">Correo</label>
                                <input type="text" class="form-control form-control-user" name="correo" placeholder="Correo" value="<?php echo $datos['email']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label for="comentarios">Comentarios</label>
                                <textarea class="form-control" id="comentarios" name="comentarios" rows="3"><?php echo $datos['comments']; ?></textarea>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $datos['id']; ?>">
                        <button type="submit" class="btn btn-primary" name="editar">Guardar cambios</button>
                    </form>
                    <a href="javascript: history.go(-1)">Volver</a>


                    
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