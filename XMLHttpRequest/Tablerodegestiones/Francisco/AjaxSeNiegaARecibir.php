
		select count(distinct(fp.barcode_externo)) as 'Contador'
		from sispoc5_gestionpostal.flash_piezas as fp
		inner join sispoc5_gestionpostal.flash_comprobantes_ingresos as ci on fp.comprobante_ingreso_id = ci.id
		#inner join sispoc5_Ocasa.PiezasSpp as PSPP on fp.barcode_externo = PSPP.Barcode
		inner join 
		(
			select pe.*
			FROM
			(
				select pe.*
				FROM
				(
					select * 
					from sispoc5_Ocasa.Piezas_Estados as pe 
					where pe.Activo = '1'
					order by pe.id desc
				)as pe
				group by pe.idPieza
			)as pe
		)as pe on pe.idPieza = fp.id
		where fp.tipo_id = 2
		and ci.cliente_id = '30'
		and pe.Activo = '1'
		and pe.idEstados in ('15')#,'17','0', '6', '14', '15', '16') #8 TARJETAS ENTREGADAS ,#0 SOLICITADAS POR EL CLIENTE (RECUPEROS) #6 Domicilio Insuficiente #14 Se Mudó #15 Se Niega A Recibir #16 Segunda visita No Entregado
		#and pe.idEstados in ('8','0','6','14','15','16') #Calculo Total
		and fp.create >  DATE_ADD('$FechaI', INTERVAL 0 HOUR) 
		AND fp.create <  DATE_ADD('$FechaF', INTERVAL 0 HOUR)
