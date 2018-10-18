
CREATE OR REPLACE FUNCTION f_listado_pago(
    IN pd_fecha1 date,
    IN pd_fecha2 date,
    IN pi_tipo integer)
  RETURNS TABLE(npago integer, fechapago date, propietario character varying, placa character, importe numeric, estado character varying) AS
$BODY$
	declare pd_fecha1 alias for $1;
	declare pd_fecha2 alias for $2;
	declare pi_tipo alias for $3;
	
	begin
		return QUERY
			
				select  p.numero_pago as NPago,
					p.fecha_pago as FechaPago,					
					pro.nombre as propietario,
					v.numero_placa as Placa,					
					sum(pd.importe_pagado) as importe,
					
					(case when p.estado = 'E' then 'ACTIVO' else 'ANULADO' end)::character varying(15) as estado
					
				from
					propietario pro inner join vehiculo v on pro.dni=v.dni
						inner join infraccion i on i.numero_placa=v.numero_placa
						inner join pago_detalle pd on pd.numero_infraccion=i.numero_infraccion 
						inner join pago p on p.numero_pago=pd.numero_pago
				---group by 1,2,3,4,6
			  and 
			  (
				case pi_tipo
					when 1 then p.fecha_pago = current_date
					when 2 then p.fecha_pago between pd_fecha1 and pd_fecha2
					else 1=1
				end
			  )

			group by 1,2,3,4,6
			  
			ORDER BY
			  p.numero_pago desc;
			  
	end;
	
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100
  ROWS 1000;
ALTER FUNCTION f_listado_pago(date, date, integer)
  OWNER TO postgres;
