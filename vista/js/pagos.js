$("#txtdni").keypress(function(evento){
    var dni = $("#txtdni").val();
    
    if (evento.which === 13){
        evento.preventDefault(); 
    console.log("CL:" +dni);    
        $.post('../controlador/propietario.buscar.controlador.php',
            {
                p_dni : dni
                
            }
        ).done(function(resultado){
            var datos = $.parseJSON(resultado);
            $("#txtdni").val(datos.dni);
            $("#lblnombrecliente").val(datos.nombre);
            $("#lbldireccioncliente").val(datos.direccion);
            $("#cbovehiculo").load('../controlador/vehiculo.cargar-combo.controlador.php?dni=' + dni);
        });
    }
});


$("#txtdni").keypress(function(evento){
    var tecla = (evento.which) ? evento.which : evento.keyCode;
    if (tecla >= 48 && tecla <= 57){
      return true;
    }
    
    return false;
});


function listar(){
    var placa = $("#cbovehiculo").val();
    if (placa == null){
        placa = 0;
    }
    $.post('../controlador/pago.listar-cuotas.controlador.php',
    {
       p_num_placa : placa
    }
        ).done(function(resultado){
            $("#listadocuotas").empty();
            $("#listadocuotas").append(resultado);
            $('#tabla-listado').dataTable({
                "aaSorting": [[1, "desc"]],
                "sScrollX": "100%",
                "sScrollXinner": "150%",
                "bScrollCollapse": true,
                "bPaginate": true
            });
        });
}


$("#cbovehiculo").change(function(){
    listar();
});

$(document).ready(function(){
    listar(); 
    $("#txtimporteneto").val(0);
});



$(document).on("dblclick", "#importepagar", function(){
   var importe = $(this).html();
   
   if (importe.substring(0,6)==="<input"){
       return 0;
   }
   
   $(this).empty().append('<input type="text" id="txtimporte" class="form-control" value = "' + importe + '"/>');
   $("#txtimporte").focus();
   
});

function calcularTotales(){
    var importeNeto = 0;
    
   $("#detallepago tr").each(function(){
       var importe = $(this).find("td").eq(4).html(); //cada monto agregado en la columna importe se va añadiendo al detalle
       importeNeto = importeNeto + parseFloat(importe);
   }); 
   
   $("#txtimporteneto").val(importeNeto.toFixed(2)); // se visualizar cada monto añadido del detalle y se muestra un total
}


$(document).on("keypress", "#txtimporte", function(evento){
    
    if (evento.which === 13){
        var importe = $(this).val();
        $(this).parents().find("td").eq(4).empty().append(importe);
    }else{
        return validarNumeros(evento);
    }
    calcularTotales();
});






$("#frmgrabar").submit(function(evento){
   evento.preventDefault();
    
   var arrayDetalle = new Array();
   
   $("#detallepago tr").each(function(){
      var importe = $(this).find("td").eq(4).html();
        
        if(importe>0){
            var numPlaca = $("#cbovehiculo").val();
            var numInfraccion = $(this).find("td").eq(0).html();

            var objDetalle = new Object();
            objDetalle.numPlaca = numPlaca;
            objDetalle.numInfraccion = numInfraccion;
            objDetalle.importe  = importe;

            arrayDetalle.push(objDetalle);
        }       
   });
   
   var detalleCompraJSON = JSON.stringify(arrayDetalle);
   
   swal({
		title: "Desea grabar el pago",
		text: "Confirme",
		
		showCancelButton: true,
		confirmButtonColor: '#83ba45',
		confirmButtonText: 'Si',
		cancelButtonText: "No",
		closeOnConfirm: false,
		closeOnCancel: true,
                imageUrl: "../imagenes/pregunta.png"
	},
	function(isConfirm){
            if (isConfirm){
                
                $.post
		    ( 
			"../controlador/pago.registrar.controlador.php",
			{
			    p_datos_cabecera: $("#frmgrabar").serialize(),
			    p_datos_detalle: detalleCompraJSON
			}
		    ).done(function(resultado){
			if (resultado==="exito"){
			    swal({
					title: "Bien",
					text: "El pago se ha registrado correctamente",
					type: "success",
					showCancelButton: false,
					confirmButtonColor: '#83ba45',
					confirmButtonText: 'Aceptar',
					closeOnConfirm: true
					//imageUrl: "../imagenes/pregunta.png"
				},
				function(isConfirm){
				    if (isConfirm){
					document.location.href="pagos-listado.php";
				    }
				});
				
			    
			}

		    }).fail(function(error){

			alert(error.responseText);
		    });
                
            }
	});
   
});

