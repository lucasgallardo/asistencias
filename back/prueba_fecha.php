<?php
echo moroso('2022-08-29');

function moroso($ultimo_pago){
    $noPagado = true;
    // $hoy = date('Y-m-d');
    $diaActual = date('d');
    if($diaActual > 7){
        $anioActual = date('Y');
        $mesActual = date('m');
        $fechaUltimoPago = explode('-', $ultimo_pago);
        $mesPago = $fechaUltimoPago[1];
        $anioPago = $fechaUltimoPago[0];
        echo "mes".$mesPago;
        echo "año".$anioPago;
        if($mesActual == $mesPago and $anioActual >= $anioPago){
            $noPagado = true;
        }else{
            $noPagado = false;
        }
    }
    
    return $noPagado;
}
?>