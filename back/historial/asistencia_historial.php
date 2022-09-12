<?php
include_once '../socios.php';
$id = $_GET['id']; 
?>
<div class="card border-info shadow" style="width: 100%;">
  <div class="card-header"><h4>Historial de asistencia</h4></div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTableAsistencia" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Fecha</th>
              <th>Hora</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Fecha</th>
              <th>Hora</th>
            </tr>
          </tfoot>
          <tbody>
            <?php echo historial_asistencia($id, $conexion);?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script src="../../vendor/jquery/jquery.min.js"></script>

<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>

<script>
      $(document).ready(function() {
        $('#dataTable').DataTable(
        {
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