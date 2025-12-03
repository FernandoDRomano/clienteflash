select count(distinct(fp.id)) as 'Contador'
from sispoc5_gestionpostal.flash_piezas as fp
inner join sispoc5_gestionpostal.flash_comprobantes_ingresos as ci on fp.comprobante_ingreso_id = ci.id
left join sispoc5_Ocasa.PiezasSpp as PSPP on fp.barcode_externo = PSPP.Barcode
left join sispoc5_Ocasa.Piezas_Estados as pe on pe.idPieza = fp.id
where fp.tipo_id = 2
and ci.cliente_id = '30'
and fp.create >  DATE_ADD('2020-02-01', INTERVAL 0 HOUR) AND fp.create <  DATE_ADD('2020-03-01', INTERVAL 0 HOUR)
and PSPP.id is null
and pe.id is null