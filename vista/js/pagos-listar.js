function listar(){
    var tipo = $("#rbtipo:checked").val();
    var fecha1 = $("#txtfecha1").val();
    var fecha2 = $("#txtfecha2").val();
    
    $.post(
            "../controlador/pago.listar.controlador.php",
            {
                p_fecha1: fecha1,
                p_fecha2: fecha2,
                p_tipo: tipo
            }
            ).done(function(resultado){
                //$("#listado").empty(); //limpiar
                //$("#listado").append(resultado);
                
                $("#listado").html(resultado);
                
                $('#tabla-listado').dataTable({
                    "aaSorting": [[1, "asc"]],
                    
                    "sScrollX":       "100%",
                    "sScrollXInner":  "100%",
                    "bScrollCollapse": true,
                    "bPaginate":       true 
                });
            })
}

$(document).ready(function(){
    listar(); 
});

$("#btnfiltrar").click(function(){
    listar(); 
});

$("#btnagregar").click(function(){
   document.location.href="pagos.php";
});


function anular(numPago){
    
    swal({
		title: "Esta seguro de anular el pago seleccionado",
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
		"../controlador/pago.anular.controlador.php",
		{
		    p_num_pago: numPago
		}
	).done(function(resultado){
			if (resultado==="exito"){
			    swal({
					title: "Bien",
					text: "El pago se ha anulado correctamente",
					type: "success",
					showCancelButton: false,
					confirmButtonColor: '#83ba45',
					confirmButtonText: 'Aceptar',
					closeOnConfirm: true
					//imageUrl: "../imagenes/pregunta.png"
				},
				function(isConfirm){
				    if (isConfirm){
					listar();
				    }
				});
				
			    
			}

		    }).fail(function(error){

			alert(error.responseText);
		    });
                
            }
	});
   
    
    
   
  /*  $.post
	(
		"../controlador/pago.anular.controlador.php",
		{
		    p_num_pago: numPago
		}
	).done(function (resultado){
	    alert(resultado);
	    if (resultado === "exito"){
		listar();
	    }
	}).fail(function(error){
	    alert(error.responseText);
	})
    */
}