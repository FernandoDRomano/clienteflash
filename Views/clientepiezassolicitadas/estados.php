<?php
    $Objeto = json_encode($_REQUEST);
    $Post = json_decode($Objeto, false);
    $InicioDeAnio = "InicioDeAnio";
    $Fecha = "Fecha";

    use Config\Elementos as Elementos;

    $userId = $_SESSION['idusuario'] ?? null;
    $perfilUsuario = $_SESSION['idperfil'] ?? null;		
    $clienteId = $_SESSION['cliente_id'] ?? null;
?>

<script>
    const USER_ID = <?= $userId !== null ? $userId : 'null' ?>;
    const PERFIL_USUARIO = <?= $perfilUsuario !== null ? $perfilUsuario : 'null' ?>;
    const CLIENTE_ID = <?= $clienteId !== null ? $clienteId : 'null ' ?>;
</script>


<!-- <link rel="stylesheet" href="<?php if (SUBDOMINIO != "") {
                                    echo ("/" . SUBDOMINIO . "/");
                                } else {
                                    echo ("/");
                                } ?>Styles/Styles/Tablero.css"> -->

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="modal fade bd-example-modal-lg" id="ModalDatos" tabindex="-1" role="dialog" aria-labelledby="ModalDatosLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalDatosLabel">Pieza <b id="DetalleDePiezaActual"></b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">

                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="EstadosDePiezasApellidoYNombre">Apellido y Nombre</label>
                                            <input class="form-control" type="text" name="EstadosDePiezasApellidoYNombre" id="EstadosDePiezasApellidoYNombre" readonly>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="EstadosDePiezasDocumento">DNI/DU</label>
                                            <input class="form-control" type="text" name="EstadosDePiezasDocumento" id="EstadosDePiezasDocumento" readonly>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="EstadosDePiezasDirecciónDeEntrega">Dirección de Entrega</label>
                                            <input class="form-control" type="text" name="EstadosDePiezasDirecciónDeEntrega" id="EstadosDePiezasDirecciónDeEntrega" readonly>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="EstadosDePiezasCodigoExterno">Codigo Externo</label>
                                            <input class="form-control" type="text" name="EstadosDePiezasCodigoExterno" id="EstadosDePiezasCodigoExterno" readonly>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="EstadosDePiezasUltimoEstado">Ultimo estado</label>
                                            <input class="form-control" type="text" name="EstadosDePiezasUltimoEstado" id="EstadosDePiezasUltimoEstado" readonly>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="EstadosDePiezasFechaUltimoEstado">Fecha último estado</label>
                                            <input class="form-control" type="text" name="EstadosDePiezasFechaUltimoEstado" id="EstadosDePiezasFechaUltimoEstado" readonly>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="EstadosDePiezasRecibió">Recibió</label>
                                            <input class="form-control" type="text" name="EstadosDePiezasRecibió" id="EstadosDePiezasRecibió" readonly>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="EstadosDePiezasVínculo">Vínculo</label>
                                            <input class="form-control" type="text" name="EstadosDePiezasVínculo" id="EstadosDePiezasVínculo" readonly>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <button type="button" class="btn btn-secondary" id="SalirDeModal" data-dismiss="modal">
                                            <i class="fas fa-undo"></i>Volver
                                        </button>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 my-4">
                                        <table id="tabla-estados" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Estado</th>
                                                    <th>Fecha</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- <div class="row">
                                    <div class="col-12 mb-4">
                                        <?php
                                        Elementos::CrearTabladashboard("EstadosDePiezas", "12", "", "display:block", false, 5000, "display:none", "display:none", false, "display:block", "display: none", "display: none");
                                        ?>
                                    </div>
                                </div> -->

                                <div class="row d-none" id="contenedor-acuse">

                                    <div class="form-group col-12">
                                        <div class="card-header text-uppercase font-weight-bold">
                                            <font>
                                                <font style="vertical-align: inherit;">Acuse En Calle</font>
                                            </font>
                                        </div>
                                        <img id="FotoAndroid" src="" class="mx-auto d-block" style="width: -webkit-fill-available;max-width: 100%;" alt="">
                                        <img id="FotoAndroidSpp" src="" class="mx-auto d-none" style="width: -webkit-fill-available;max-width: 100%;" alt="">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    #ModalDatos ::-webkit-scrollbar {
        width: 16px;
    }

    #ModalDatos ::-webkit-scrollbar-track {
        background: #00F0F0;
    }

    #ModalDatos ::-webkit-scrollbar-thumb {
        background: #00B0B0;
    }

    #ModalDatos ::-webkit-scrollbar-thumb:hover {
        background: #00A0A0;
    }

    .form-control:focus {
        box-sizing: border-box;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25) !important;
    }

    .card-header {
        color: #fff;
        background-color: #292d57;
        border-bottom: 1px solid #292d57;
        padding: .75rem 1.25rem;
    }

    /* Evitar que los encabezados de TablaSolicitudes se rompan en varias líneas */
    #TablaSolicitudes thead th {
        white-space: nowrap;
        vertical-align: middle;
    }
</style>


<!-- CARD CON FORMULARIO -->
<div class="row justify-content-center mt-3">
    <div class="col-11">
        <div class="card">
            <div class="card-header">
                <p class="mb-0 text-center text-lg">Consulta de Piezas</p>
            </div>
            <div class="card-body">

                <div class="form-row">

                    <div class="form-group col-12 col-md-6 col-xl-4">
                        <label for="Documento">DNI/DU:</label><span> (Solo v&aacute;lido para carta documento)</span>
                        <input type="text" name="Documento" id="Documento" placeholder="Ingrese su DNI/DU" class="form-control">
                    </div>

                    <div class="form-group col-12 col-md-6 col-xl-8">
                        <label for="ApellidoYNombre">Apellido y nombre:</label>
                        <input type="text" name="ApellidoYNombre" id="ApellidoYNombre" placeholder="Ingrese su apellido y nombre" class="form-control">
                    </div>

                    <div class="form-group col-md-6 col-xl-4" id="datetimepicker1">
                        <label for="FechaDesde">Fecha ingreso desde:</label>
                        <div class="input-group">
                            <input type="date" name="FechaDesde" id="FechaDesde" class="datepicker form-control" placeholder="Ingrese la fecha desde">
                            <label class="input-group-append mb-0" for="FechaDesde">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group col-md-6 col-xl-4" id="datetimepicker2">
                        <label for="FechaHasta">Fecha ingreso hasta:</label>
                        <div class="input-group">
                            <input type="date" name="FechaHasta" id="FechaHasta" class="datepicker form-control" placeholder="Ingrese la fecha hasta">
                            <label class="input-group-append mb-0" for="FechaHasta">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group col-12">
                        <label for="BarcodeExterno">Código de Seguimiento:</label> <!-- Número de pieza -->
                        <input type="text" name="BarcodeExterno" id="BarcodeExterno" placeholder="Ingrese su número de pieza" class="form-control">
                    </div>

                    <div class="form-group col-12 d-flex justify-content-end" style="gap: .5rem;">
                        <!-- <button style="display: none;" class="btn bg-blue mx-md-1 mx-lg-0 mr-lg-1" onclick="verificar()"><i class="fas fa-search"></i> Buscar</button> -->
                        <button  class="btn mx-md-1 mx-lg-0 mr-lg-1 btn-buscar-piezas" onclick="verificarSispo()"><i class="fas fa-search" ></i> Buscar</button>
                        <button class="btn mx-md-1 mx-lg-0 ml-lg-1 btn-exportar-piezas" onclick="exportarCSVTabla()"><i class="fas fa-file-excel mr-1"></i>Reporte</button>
                    </div>

                </div>

                <hr>
                <!-- ACOMODAR JS PARA LAS NUEVAS COLUMNAS -->
                <div class="form-row">
                    <div class="col-12" id="ResultadosBusqueda">
                        <table id="TablaSolicitudes" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id Pieza</th>
                                    <th>Barcode externo</th>
                                    <th>Sucursal</th>
                                    <th>Destinatario</th>
                                    <th>Direcci&oacute;n de entrega</th>
                                    <th>CP</th>
                                    <th>Localidad</th>
                                    <th>Estado actual</th>
                                    <th>Fecha del estado actual</th>
                                    <th>Ingreso L&oacute;gico</th>
                                    <th>Fecha</th>
                                    <th>Ingreso F&iacute;sico</th>
                                    <th>Fecha</th>
                                    <th>Enviado a (1)</th>
                                    <th>Fecha</th>
                                    <th>Recibido en (1)</th>
                                    <th>Fecha</th>
                                    <th>Enviado a (2)</th>
                                    <th>Fecha</th>
                                    <th>Recibido en (2)</th>
                                    <th>Fecha</th>
                                    <th>Fecha 1ra Dist.</th>
                                    <th>Resultado</th>
                                    <th>Fecha</th>
                                    <th>Fecha 2da Dist.</th>
                                    <th>Resultado</th>
                                    <th>Fecha</th>
                                    <th>Fecha 3ra Dist.</th>
                                    <th>Resultado</th>
                                    <th>Fecha</th>
                                    <th>&Uacute;ltima Novedad</th>
                                    <th>Fecha</th>
                                    <th>Imagen</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tfoot>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>

                <!-- TABLA -->
                <!-- <?php
                Elementos::CrearTabla("Solicitudes", "12", "", "display:block", false, 10, "display:none", "display:none", false, "display:block");
                ?> -->
                <!-- END TABLA -->

            </div>
        </div>
    </div>
</div>