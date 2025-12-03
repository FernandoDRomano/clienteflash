
		select count(distinct(TU.id)) as 'Contador'
		# select count(distinct(TU.id)) as id
		from
		(
			select distinct(fp.barcode_externo) as id #select distinct(fp.id) as id
			from sispoc5_gestionpostal.flash_piezas as fp
			inner join sispoc5_gestionpostal.flash_comprobantes_ingresos as ci on fp.comprobante_ingreso_id = ci.id
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
			and pe.idEstados in ('1', '13') #8 TARJETAS ENTREGADAS ,#0 SOLICITADAS POR EL CLIENTE (RECUPEROS) #6 Domicilio Insuficiente #14 Se Mudó #15 Se Niega A Recibir #16 Segunda visita No Entregado
			and fp.create >  DATE_ADD('$FechaI', INTERVAL 0 HOUR) AND fp.create <  DATE_ADD('$FechaF', INTERVAL 0 HOUR)
			
			union
			
			select distinct(fp.barcode_externo) as id #SELECT distinct(fp.id) as 'id'
			FROM sispoc5_gestionpostal.flash_piezas as fp
			inner join sispoc5_gestionpostal.flash_comprobantes_ingresos as ci on fp.comprobante_ingreso_id = ci.id
			inner join sispoc5_Ocasa.PiezasSpp as PSPP on fp.barcode_externo = PSPP.Barcode
            left join 
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
			)as NOTPE on PSPP.Barcode = NOTPE.BarcodeExterno
			where 
			(NOTPE.id is null 
				or 
				(
					(PSPP.FechaDeEstado > DATE_ADD(NOTPE.Fecha, INTERVAL $DiferenciaHoraria HOUR) and NOTPE.Activo = '1' )
					and
					NOTPE.idEstados in ('1','13')
				)
			)
			and ci.cliente_id = '30'
			and fp.tipo_id = 2
			and fp.create >  DATE_ADD('$FechaI', INTERVAL 0 HOUR) AND fp.create <  DATE_ADD('$FechaF', INTERVAL 0 HOUR)
        ) as TU
