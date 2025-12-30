<?php
    use Models\PerfilCliente;
    use Models\CartaDocumentoEstado;

    $userId = $_SESSION['idusuario'] ?? null;
    $perfilUsuario = $_SESSION['idperfil'] ?? null;		
    $clienteId = $_SESSION['cliente_id'] ?? null;

    //Redirigir si el usuario no tiene permisos para acceder a esta página
    if (!in_array($perfilUsuario, [PerfilCliente::ADMINISTRADOR, PerfilCliente::AUTORIZADOR, PerfilCliente::IMPRIMIDOR])) {
        echo "<script>window.location.href = '/principal/inicio';</script>";
        exit();
    }
?>

<script>
    const USER_ID = <?= $userId !== null ? $userId : 'null' ?>;
    const PERFIL_USUARIO = <?= $perfilUsuario !== null ? $perfilUsuario : 'null' ?>;
    const CLIENTE_ID = <?= $clienteId !== null ? $clienteId : 'null ' ?>;

    const CARTA_DOCUMENTO_ESTADO = {
        PENDIENTE: <?= CartaDocumentoEstado::PENDIENTE ?>,
        AUTORIZADO: <?= CartaDocumentoEstado::AUTORIZADO ?>,
        RECHAZADO: <?= CartaDocumentoEstado::RECHAZADO ?>
    };

    const PERFILES_USUARIOS = {
        ADMINISTRADOR: <?= PerfilCliente::ADMINISTRADOR ?>,
        AUTORIZADOR: <?= PerfilCliente::AUTORIZADOR ?>,
        CREADOR: <?= PerfilCliente::CREADOR ?>,
        IMPRIMIDOR: <?= PerfilCliente::IMPRIMIDOR ?>
    };
</script>

<!-- PDF.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script>
    // Configurar el worker de PDF.js
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';
</script>

<div class="row justify-content-center mt-3">
    <div class="col-11">
        <div class="card">
            <div class="card-header">
                <p class="mb-0 text-center text-lg">Gesti&oacute;n de Cartas Documentos</p>
            </div>

            <div class="card-body">

                <h3 class="form-titulo-seccion">Filtros</h3>

                <div class="form-row">
                    <img id="imgBase" src="BasePDF.jpg" alt="Imagen Base Carta Documento" height="auto" width="auto" hidden>

                    <div class="form-group col-12 col-md-3">
                        <label for="EstadoCartaDocumento">Estado</label>
                        <select name="EstadoCartaDocumento" id="EstadoCartaDocumento" class="select-2 d-none form-control select1-Borrado  select1-hidden-accessible-Borrado">
                            <option value="">Seleccionar</option>
                            <option value="<?= CartaDocumentoEstado::PENDIENTE ?>">Pendiente</option>
                            <option value="<?= CartaDocumentoEstado::AUTORIZADO ?>">Autorizado</option>
                            <option value="<?= CartaDocumentoEstado::RECHAZADO ?>">Rechazado</option>
                        </select>
                    </div>

                    <div class="form-group col-12 col-md-9">
                        <label for="UsuarioCartaDocumento">Usuario</label>
                        <select name="UsuarioCartaDocumento" id="UsuarioCartaDocumento" class="select-2 d-none form-control select1-Borrado  select1-hidden-accessible-Borrado">
                            <option value="">Seleccionar</option>
                        </select>
                    </div>

                    <div class="form-group col-md-5" id="datetimepicker1">
                        <label for="FechaDesde">Fecha desde:</label>
                        <div class="input-group">
                            <input type="date" name="FechaDesde" id="FechaDesde" class="datepicker form-control" placeholder="Ingrese la fecha desde">
                            <label class="input-group-append mb-0" for="FechaDesde">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group col-md-5" id="datetimepicker2">
                        <label for="FechaHasta">Fecha hasta:</label>
                        <div class="input-group">
                            <input type="date" name="FechaHasta" id="FechaHasta" class="datepicker form-control" placeholder="Ingrese la fecha hasta">
                            <label class="input-group-append mb-0" for="FechaHasta">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group col-12 col-md-2 d-flex align-items-end">
                        <button onclick="buscarCartasDocumentos(event)" id="btnBuscarCartaDocumento" class="btn btn-primary btn-block d-flex justify-content-center align-items-center" style="height: 43px; gap: 5px;"><i class="fas fa-search"></i> Buscar</button>
                    </div>
                </div>

                <hr>
                <!-- ACOMODAR JS PARA LAS NUEVAS COLUMNAS -->
                <div class="form-row">
                    <div class="col-12" id="ResultadosBusqueda">
                        <table id="tabla-cd" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Estado</th>
                                    <th>Usuario Creaci&oacute;n</th>
                                    <th>Fecha Creaci&oacute;n</th>
                                    <th>Usuario Autorizaci&oacute;n</th>
                                    <th>Fecha Autorizaci&oacute;n</th>
                                    <th>Usuario Rechazo</th>
                                    <th>Fecha Rechazo</th>
                                    <th>Destinatario</th>
                                    <th>Provincia</th>
                                    <th>Localidad</th>
                                    <th>C&oacute;digo Postal</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>