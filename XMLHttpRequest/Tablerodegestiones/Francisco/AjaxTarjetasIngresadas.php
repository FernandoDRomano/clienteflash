
		select count(distinct(fp.id)) as 'Contador'
		from sispoc5_gestionpostal.flash_piezas as fp
		inner join sispoc5_gestionpostal.flash_comprobantes_ingresos as ci on fp.comprobante_ingreso_id = ci.id
		#inner join sispoc5_Ocasa.PiezasSpp as PSPP on fp.barcode_externo = PSPP.Barcode
		where fp.tipo_id = 2
		and ci.cliente_id = '30'
		and fp.create >  DATE_ADD('$FechaI', INTERVAL 0 HOUR) AND fp.create <  DATE_ADD('$FechaF', INTERVAL 0 HOUR)
