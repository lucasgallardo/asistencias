function dato_asistencia(id)
{ 
  var parametros = 
  {
    "id" : id
  };

  $.ajax({
    data: parametros,
    url: 'back/asistencia.php',
    type: 'POST',
    
    beforesend: function()
    {
      $('#mostrar_mensaje'+id).html("Mensaje antes de Enviar");
    },

    success: function(mensaje)
    {
      $('#mostrar_mensaje'+id).html(mensaje);
    }
  });
}

function eliminar_pago(id_pago, id)
{ 
  if (confirm('¿Está seguro que desea eliminar?')){
    var parametros = 
    {
      "id" : id,
      "id_pago": id_pago
    };

    $.ajax({
      data: parametros,
      url: 'back/pagos.php',
      type: 'POST',
      
      beforesend: function()
      {
        $('#mensaje_eliminar').html("Eliminando...");
      },

      success: function(mensaje)
      {
        $('#mensaje_eliminar').html(mensaje);
        historial_pagos(id)
      }
    });
  }
  
}
