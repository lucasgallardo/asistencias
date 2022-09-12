<?php 
include_once 'conexion.php';
$id = $_GET['id'];
$dato = pago_datos($id, $conexion);

?>
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
            <input type="text" class="form-control" id="monto" name="monto" aria-describedby="tituloHelp" value="<?php echo $dato['amount']; ?>">
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
                <option value="debito">Dëbito</option>
                <option value="credito">Crédito</option>
            </select>
        </div>
    </div>
    <input type="hidden" name="id" value="<?php echo $datos['id']; ?>">
    <button class="btn btn-primary btn-user btn-block" type="submit" name="agregar">
        Guardar
    </button>
</form>