UPDATE sispoc5_consultasweb.piezas consultasweb
LEFT JOIN 
(
    select *
    FROM
    (
        SELECT SUBSTRING(TI.Telefono,1,2) as 'Destino' , concat('CF', TI.NumeroDeTarjeta) as 'Barcode'
        FROM sispoc5_Banco.TarjetasImpresas as TI
        inner join
        (
            SELECT *
            FROM sispoc5_consultasweb.piezas as scw
            WHERE scw.MotivoPieza like '' or scw.DatoBanco like ''
            #DatoBanco
        ) as scw2 ON TI.NumeroDeTarjeta = scw2.NumPiezaBanco #CONCAT('cf',TI.NumeroDeTarjeta)
        WHERE 1

        UNION

        SELECT TD.DestinoSegunCodigoDeEmision  as 'Destino' , concat('CF', TD.Tarjeta) as 'Barcode'
        FROM sispoc5_Banco.tarjetasDeDebito as TD
        inner join
        (
            SELECT *
            FROM sispoc5_consultasweb.piezas as scw
            WHERE scw.MotivoPieza like '' or scw.DatoBanco like ''
            #DatoBanco
        ) as scw2 ON TD.Tarjeta = scw2.NumPiezaBanco #CONCAT('cf',TI.NumeroDeTarjeta)
        WHERE 1

        UNION

        SELECT TSCE.Distribucion as 'Destino' , concat('CF',TSCE.SecuenciaDeTargeta) as 'Barcode'
        FROM sispoc5_Banco.TarjetasSinChipEMV as TSCE
        inner join
        (
            SELECT *
            FROM sispoc5_consultasweb.piezas as scw
            WHERE scw.MotivoPieza like '' or scw.DatoBanco like ''
            #DatoBanco
        ) as scw2 ON TSCE.SecuenciaDeTargeta = scw2.NumPiezaBanco COLLATE utf8_unicode_ci
        WHERE 1
    ) as CU
    where 1
) as CU on CU.Barcode = consultasweb.NumPiezaCorreo COLLATE utf8_unicode_ci
SET
consultasweb.DatoBanco  = 
(
    case CU.Destino
    when '' then 'Sucursal'
    when 'AL CLIENT'  then 'Domicilio'
    when 'F1'  then 'Domicilio'
    when 'F2'  then 'Sucursal'
    when 'K1'  then 'Domicilio'
    when 'K2'  then 'Sucursal'
    else '' 
    end
),
consultasweb.MotivoPieza = 
(
    case CU.Destino
    when '' then 'Sucursal'
    when 'AL CLIENT' then 'Domicilio'
    when 'F1'  then 'Domicilio'
    when 'F2'  then 'Sucursal'
    when 'K1'  then 'Domicilio'
    when 'K2'  then 'Sucursal'
    else '' 
    end
)