<?php 
  include 'back/util.php';
  is_logued();
  is_admin();
  include 'back/user.php';

  $id = $_GET['id'];
  $datos = datos_user($id, $conexion);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Octopus - Perfil usuario</title>

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
                    <h1 class="h3 mb-4 text-gray-800">Perfil del usuario <?php echo $datos['name']." ".$datos['surname']; ?></h1>
                    <?php echo any_message(); ?>
                    <form method="POST" action="back/user.php">
                        <div class="form-group row">
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <label for="numero">Nombre</label>
                                <input type="text" class="form-control form-control-user" name="name" placeholder="Nombre" value="<?php echo $datos['name']; ?>">
                            </div>
                            <div class="col-sm-4">
                                <label for="documento">Apellido</label>
                                <input type="text" class="form-control form-control-user" name="surname" placeholder="Apellido" value="<?php echo $datos['surname']; ?>">
                            </div>
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <label for="numero">Rol</label>
                                <select class="custom-select custom-select mb-3" name="type">
                                    <?php echo user_type($datos['role']); ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="numero">Email</label>
                                <input type="email" class="form-control form-control-user" name="email" placeholder="Correo electrónico" value="<?php echo $datos['email']; ?>">
                            </div>
                        </div>
                        <input type="hidden" name="id_user" value="<?php echo $id; ?>">
                        <button type="submit" class="btn btn-primary" name="actualiza">Actualizar datos</button>
                    </form>
                    
                    <hr>
                    <h3 class="h3 mb-4 text-gray-800">Reiniciar contraseña</h3>
                    <form method="POST" action="back/user.php">
                        <div class="form-group row">
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <input type="hidden" class="form-control form-control-user" name="id_user" value="<?php echo $datos['id']; ?>">
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-warning" name="reiniciar">Reiniciar</button>
                    </form>

                    
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
<br>
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
                    <a class="btn btn-primary" href="login.php">Salir</a>
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
    <script>
        $(document).ready(function() {
            //variables
            var pass1 = $('[name=new]');
            var pass2 = $('[name=new2]');
            var confirmacion = "Las contraseñas si coinciden";
            var longitud = "La contraseña debe estar formada entre 3-10 carácteres (ambos inclusive)";
            var negacion = "No coinciden las contraseñas";
            var vacio = "La contraseña no puede estar vacía";
            //oculto por defecto el elemento span
            var span = $('<span></span>').insertAfter(pass2);
            span.hide();
            //función que comprueba las dos contraseñas
            function coincidePassword(){
                var valor1 = pass1.val();
                var valor2 = pass2.val();
                //muestro el span
                span.show().removeClass();
                //condiciones dentro de la función
                if(valor1 != valor2){
                span.text(negacion).addClass('negacion');	
                }
                if(valor1.length==0 || valor1==""){
                span.text(vacio).addClass('negacion');	
                }
                if(valor1.length<3 || valor1.length>10){
                span.text(longitud).addClass('negacion');
                }
                if(valor1.length!=0 && valor1==valor2){
                span.text(confirmacion).removeClass("negacion").addClass('confirmacion');
                }
            }
            //ejecuto la función al soltar la tecla
            pass2.keyup(function(){
                coincidePassword();
            });
        });
    </script>

</body>

</html>