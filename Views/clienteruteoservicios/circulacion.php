<?php
$Objeto = json_encode($_REQUEST);
$Post = json_decode($Objeto, false);
$InicioDeAnio = "InicioDeAnio";
$Fecha = "Fecha";

use Config\Elementos as Elementos;

//obtener cliente
$usuario = $_SESSION['idusuario'];
//print_r($usuario);

//hacer peticion con ese cliente
//$peticion_get_datos = file_get_contents('https://ruteo.sppflash.com.ar/api/seguimiento_online_peticiones?id_usuario=' . $usuario);  
$peticion_get_datos = file_get_contents('https://ruteo.intranetflash.com/api/seguimiento_online_peticiones?id_usuario=' . $usuario);  

$datos = json_decode($peticion_get_datos, true);

//echo "datos";
//var_dump($peticion_get_datos);

$sucursales = $datos[sucursales];
//$tipos_carteros = $datos[tipos_carteros];
$carteros = $datos[carteros];

//$carteros_cliente = $datos[carteros_id];
//var_dump($carteros_cliente);

?>


<link rel="stylesheet" href="<?php if (SUBDOMINIO != "") {
                                    echo ("/" . SUBDOMINIO . "/");
                                } else {
                                    echo ("/");
                                } ?>Styles/Styles/Tablero.css">


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
    
</style>


<!-- CARD CON FORMULARIO -->
<div class="row justify-content-center mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-principal text-white">
                <p class="mb-0 text-center text-lg">Circulacion de Carteros</p>
            </div>
            <div class="card-body">
                <div>
                    <div class="form-group">
                        <label for="fSucursal">Sucursal:</label>
                        <select class="d-none custom-select selectjs form-control border" id="fSucursal" name="fSucursal" onchange="filtrar_selecs()">
                            <option value="0">Todos</option>
                            <?php
                                if(count($sucursales) > 0){
                                    foreach($sucursales as $sucursal) {
                                        echo('<option value=' . $sucursal[id] . '>' . $sucursal[nombre] . '</option>');
                                    }
                                }        
                            ?>
                        </select>
                    </div>

                    
                    
                    <div class="form-group">
                        <label for="fCartero">Carteros</label>
                        <select class="d-none selectjs border" id="fCartero" name="fCartero" onchange="" required>
                            <option value="0" disabled>Seleccione</option>
                            <?php
                                if(count($carteros) > 0){
                                    foreach($carteros as $cartero) {
                                        echo('<option value=' . $cartero[id] . '>' . $cartero[apellido_nombre] . '</option>');
                                    }
                                }        
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="fFecha">Fecha</label>
                        <br>
                        <input type="date" id="fFecha" name="fFecha" class="form-control">
                    </div>    

                    <div class="form-group d-flex justify-content-around justify-content-md-center justify-content-lg-end">
                        <button class="btn bg-blue mx-md-1 mx-lg-0 mr-lg-1" onclick="buscar_circulacion()"><i class="fas fa-search"></i> Buscar</button>
                    <!--   
                        <button class="btn bg-green mx-md-1 mx-lg-0 ml-lg-1" onclick=""><i class="fas fa-file-excel mr-1"></i>Exportar</button>
                    -->
                    </div>  

                    <div>
                        <hr>
                        <div id="googleMap" style="width: 100%; height: 600px; margin-top: 20px;"></div>
                    </div>              
                </div>
            </div>
        </div>
    </div>
</div>


<script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCNju-w0-QTEWPXL_r1UTUs4eOkNDxw89o&libraries=geometry,places">
</script>

<script>

    $(".selectjs").select2({
	    theme: 'bootstrap4',
        language: "es",
    });
        //inicializo los datepicker


    const carteros = <?= json_encode($carteros) ?>;
   // const tipos_carteros = <?= json_encode($tipos_carteros) ?>;
    const sucursales = <?= json_encode($sucursales) ?>;

    
    function filtrar_selecs(){
        let fSucursal = document.getElementById('fSucursal').value;
        //let fTipoCartero = document.getElementById('fTipoCartero').value

        $('#fCartero').empty();
        //console.log(fSucursal + ' / ' + fTipoCartero);

        carteros.filter(c => {
           // let tipo = true;
            let suc = true;
/*
            if(fTipoCartero != 0){
                tipo = c.cartero_tipo_id == fTipoCartero;
            }
*/
            if(fSucursal != 0){
                suc = c.sucursal_id == fSucursal
            }

            //return tipo && suc
            return suc
        })
        .forEach(c => {
            $('#fCartero').append(new Option(c.apellido_nombre, c.id, false, false)).trigger('change')
        })
    }

    function buscar_circulacion(){
        let cartero_id_seleccion = document.getElementById('fCartero').value;

        let fecha_seleccion = document.getElementById('fFecha').value;

        if(cartero_id_seleccion != 0 && fecha_seleccion != ''){
            //carga loading

            peticion_circulacion(cartero_id_seleccion, fecha_seleccion);    
        }
        else{
            alert('Aviso:\n. Seleccione por favor un cartero y una fecha para que el sistema pueda realizar la busqueda de la Circulacion.')
        }
        

    }


</script>