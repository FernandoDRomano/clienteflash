	<?php
    $Objeto = json_encode($_REQUEST);
    $Post = json_decode($Objeto, false);
    $InicioDeAnio = "InicioDeAnio";
    $Fecha = "Fecha";
    if (isset($_SESSION['idusuario'])) {
        $UserId = $_SESSION['idusuario'];
        //$IdUsuarioSpp = $_SESSION['idusuario'];
    }

    use Config\Elementos as Elementos;

    ?>
	<style>
	    #mapa {
	        height: 100%;
	    }

	    html,
	    body {
	        height: 100%;
	        margin: 0;
	        padding: 0;
	    }

	    #floating-panel {
	        position: absolute;
	        top: 10px;
	        left: 25%;
	        z-index: 5;
	        background-color: #fff;
	        padding: 5px;
	        border: 1px solid #999;
	        text-align: center;
	        font-family: 'Roboto', 'sans-serif';
	        line-height: 30px;
	        padding-left: 10px;
	    }

	    #floating-panel {
	        position: absolute;
	        top: 5px;
	        left: 50%;
	        margin-left: -180px;
	        width: 350px;
	        z-index: 5;
	        background-color: #fff;
	        padding: 5px;
	        border: 1px solid #999;
	    }

	    #latlng {
	        width: 225px;
	    }
	</style>

	<img src="/clienteflash/XMLHttpRequest/FirmasDeClientes/uploads/IMG_20200414_120127720.jpg" id="mug" hidden />
	<canvas id="myCanvas" width="400px" height="auto" hidden></canvas>

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
	        background: #c0c0c0;
	    }

	    #ModalDatos ::-webkit-scrollbar-thumb {
	        background: #000000;
	    }

	    #ModalDatos ::-webkit-scrollbar-thumb:hover {
	        background: #505050;
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

	    .escondibles {
	        border-style: groove;
	        border-color: #33333305;
	    }
	</style>

	<div class="modal fade bd-example-modal-lg" id="ModalDatos" tabindex="-1" role="dialog" aria-labelledby="ModalDatosLabel" aria-hidden="true">
	    <div class="modal-dialog modal-lg" role="document">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title" id="ModalDatosLabel">Importante </h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                </button>
	            </div>
	            <div class="modal-body">
	                <div class="container-fluid">
	                    <div class="row" id="container">
	                        <div class="col-md-12">
	                            <p style="text-align: justify;text-shadow: 2px 2px 10px #bfbfbf;border-style: double;padding: inherit;border-color: #292d57;">Una vez confirmada la Carta Documento los datos contenidos en la misma no podrán modificarse. Controle antes de confirmar su envío ya que luego no se podrán hacer reclamos al correo por datos incorrectos o inexistentes</p>
	                        </div>
	                    </div>
	                    <div class="row justify-content-between">
	                        <button type="button" class="btn btn-secondary mb-3 mb-lg-0" id="SalirDeModal" data-dismiss="modal">
	                            Volver A Edicion De Carta Documento
	                        </button>
	                        <button type="button" class="btn btn-primary" id="SalirDeModal" onclick="EnviarCartaDoccumento(this)">
	                            Confirmar Y Enviar Carta Documento
	                        </button>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

	<?php

    Elementos::StartHide("ApiKey");
    Elementos::EndHide();
    Elementos::StartHide("SecretKey");
    Elementos::EndHide();
    ?>

	<div class="row justify-content-center mt-3">
	    <div class="col-12">
	        <div class="card">
	            <div class="card-header bg-principal text-white">
	                <p class="mb-0 text-center text-lg">Formulario</p>
	            </div>
	            <div class="card-body">

	                <h3 class="h3 text-uppercase font-weight-bold">Plantillas Predefinidas</h3>
	                <hr class="mt-1">

	                <!-- CONTENT EDITABLE -->
	                <div class="row">
	                    <div class="col-md-12">

	                        <label for="custom-select-input"></label>
	                        <div id='custom-select-status' class='hidden-visually' aria-live="polite"></div>
	                        <div class="custom-select" id="myCustomSelect">
	                            <input type="text" id="custom-select-input" style="position: absolute; top: 0; left: 0;" class="select-css" aria-describedby="custom-select-info">
	                            <span id="custom-select-info" class="hidden-visually">Arrow down for options or start typing to filter.</span>
	                            <span class="custom-select-icons">
	                                <svg width="16" height="16" viewBox="0 0 16 16" focusable="false" aria-hidden="true" id="icon-circle-down" class="icon" role="img">
	                                    <path d="M16 8c0-4.418-3.582-8-8-8s-8 3.582-8 8 3.582 8 8 8 8-3.582 8-8zM1.5 8c0-3.59 2.91-6.5 6.5-6.5s6.5 2.91 6.5 6.5-2.91 6.5-6.5 6.5-6.5-2.91-6.5-6.5z"></path>
	                                    <path d="M4.957 5.543l-1.414 1.414 4.457 4.457 4.457-4.457-1.414-1.414-3.043 3.043z"></path>
	                                </svg>
	                                <svg width="16" height="16" viewBox="0 0 16 16" focusable="false" aria-hidden="true" id="icon-circle-up" class="icon hidden-all" role="img">
	                                    <path d="M0 8c0 4.418 3.582 8 8 8s8-3.582 8-8-3.582-8-8-8-8 3.582-8 8zM14.5 8c0 3.59-2.91 6.5-6.5 6.5s-6.5-2.91-6.5-6.5 2.91-6.5 6.5-6.5 6.5 2.91 6.5 6.5z"></path>
	                                    <path d="M11.043 10.457l1.414-1.414-4.457-4.457-4.457 4.457 1.414 1.414 3.043-3.043z"></path>
	                                </svg>
	                            </span>
	                            <ul class="custom-select-options hidden-all" id="custom-select-list" style="padding-top: 40px; left: 0;">
	                                <li>
	                                    <strong style="font-size: 2em;">Despido Con Causa</strong>
	                                    <strong class="data" style="font-size: 12px;color: darkgray;" hidden>Habiéndose acreditado que Ud. [descripción de la causa], siendo tales hechos graves y violatorios de la buena fe laboral, dañinos para la empresa y configurantes de injuria laboral grave queda Ud. despedido a partir de la fecha, conforme lo dispuesto por art. 242 LCT (justa causa). Ponemos a su disposición haberes devengados y certificados art. 80 LCT. Queda Ud. debidamente notificado.
	                                    </strong>
	                                </li>
	                                <li>
	                                    <strong style="font-size: 2em;">Despido Por Abandono De Trabajo</strong>
	                                    <strong class="data" style="font-size: 12px;color: darkgray;" hidden>Ante sus inasistencias injustificadas de los días [días] y no habiéndose presentado a justificar las mismas ni ha retomado sus tareas, lo notificamos por este medio fehaciente que ha quedado incurso en abandono de trabajo. Haberes, liquidación final y certificados art 80 LCT a su disposición. Queda Ud. debidamente notificado.
	                                    </strong>
	                                </li>
	                                <li>
	                                    <strong style="font-size: 2em;">Despido Sin Causa</strong>
	                                    <strong class="data" style="font-size: 12px;color: darkgray;" hidden>Por medio de la presente comunicamos a Ud. que a partir del día de la fecha [fecha] prescindimos de sus servicios. Liquidación final y certificados art. 80 LCT a su disposición en términos de ley. Queda Ud. debidamente notificado.
	                                    </strong>
	                                </li>
	                                <li>
	                                    <strong style="font-size: 2em;">Intimación A Desalojo Por Finalizacion De Locacion</strong>
	                                    <strong class="data" style="font-size: 12px;color: darkgray;" hidden>En su carácter de locatario del inmueble ubicado en [dirección e identificación del inmueble], propiedad del Sr. [nombre propietario] de acuerdo al contrato de locación de fecha [fecha contrato de locación] por Ud. firmado, lo intimamos por esta vía al desalojo de dicho inmueble, en virtud de haber operado el día [fecha vencimiento de contrato] el vencimiento del plazo pactado en el contrato mencionado. De no proceder a desalojar el inmueble dentro de las 24 horas siguientes a la recepción de la presente me veré obligado a iniciar las correspondientes acciones judiciales. Asimismo hago expresa reserva de accionar por los daños y perjuicios ocasionados. Queda Ud. debidamente notificado.
	                                    </strong>
	                                </li>
	                                <li>
	                                    <strong style="font-size: 2em;">Intimación A Desalojo Por Incumplimiento De Contrato De Locacion</strong>
	                                    <strong class="data" style="font-size: 12px;color: darkgray;" hidden>En su carácter de locatario del inmueble ubicado en [dirección e identificación del inmueble], propiedad del Sr. [nombre propietario] de acuerdo al contrato de locación de fecha [fecha de contrato de locación] por Ud. firmado, lo intimamos por esta vía a que abone los alquileres atrasados correspondientes a los meses de [meses atrasados ] más intereses y gastos a la fecha de la presente, lo que hace un total de [moneda de pago en letras] ($ [total en números]), dentro de las [horas ] horas de recibida la presente en [lugar de pago] de lunes a viernes en el horario de [horario desde] a [horario hasta] horas.
	                                        En caso de incumplimiento de dicha intimación, declaramos rescindido el contrato de locación según lo estipulado en la cláusula [cláusula] del mismo y se iniciará acción judicial por desalojo y cobro de dicha deuda contra Ud. y el Fiador por capital, intereses y costas. Queda Ud. debidamente notificado.
	                                    </strong>
	                                </li>
	                                <li>
	                                    <strong style="font-size: 2em;">Intimación A Regularizar Situacion Laboral</strong>
	                                    <strong class="data" style="font-size: 12px;color: darkgray;" hidden>Ante su negativa a otorgar tareas desde el día [día desde] hasta la fecha pese a mis insistencias, intimo por este medio aclare situación laboral y me otorgue tareas dentro de las 48 hs., caso contrario me consideraré gravemente injuriado/a y despedido/a por su exclusiva culpa. Queda Ud. legalmente notificado.
	                                    </strong>
	                                </li>
	                            </ul>
	                        </div>

	                        <div class='PanelDeEscondibles'>
	                            <div class="col-md-3 Escondibles" style="display:none">
	                                <a href="../Documentos/NuevaPlantilla.xlsx" download="">Plantilla Para Este Formulario<img src="../xlsx-512.png" alt="Documento Base" width="52px">
	                                </a>
	                            </div>
	                            <div class="col-md-3 Escondibles" style="display:none">
	                                <a href="../Documentos/DespidoConCausa.xlsx" download="">Plantilla Para Este Formulario<img src="../xlsx-512.png" alt="Documento Base" width="52px">
	                                </a>
	                            </div>
	                            <div class="col-md-3 Escondibles" style="display:none">
	                                <a href="../Documentos/DespidoPorAbandonoDeTrabajo.xlsx" download="">Plantilla Para Este Formulario<img src="../xlsx-512.png" alt="Documento Base" width="52px">
	                                </a>
	                            </div>
	                            <div class="col-md-3 Escondibles" style="display:none">
	                                <a href="../Documentos/DespidoSinCausa.xlsx" download="">Plantilla Para Este Formulario<img src="../xlsx-512.png" alt="Documento Base" width="52px">
	                                </a>
	                            </div>
	                            <div class="col-md-3 Escondibles" style="display:none">
	                                <a href="../Documentos/IntimaciónADesalojoPorFinalizaciónDeLocación.xlsx" download="">Plantilla Para Este Formulario<img src="../xlsx-512.png" alt="Documento Base" width="52px">
	                                </a>
	                            </div>
	                            <div class="col-md-3 Escondibles" style="display:none">
	                                <a href="../Documentos/IntimaciónADesalojoPorIncumplimientoDeContratoDeLocación.xlsx" download="">Plantilla Para Este Formulario<img src="../xlsx-512.png" alt="Documento Base" width="52px">
	                                </a>
	                            </div>
	                            <div class="col-md-3 Escondibles" style="display:none">
	                                <a href="../Documentos/IntimaciónARegularizarSituaciónLaboral.xlsx" download="">Plantilla Para Este Formulario<img src="../xlsx-512.png" alt="Documento Base" width="52px">
	                                </a>
	                            </div>
	                        </div>
	                    </div>

	                    <hr class="size2 hideline">

	                    <div class="col-md-12 p-3" style="border-color: black;border-style: double;">

	                        <h4 class="font-weight-bold text-uppercase">Crea tu Plantilla</h4>

	                        <div id="toolBar2">
	                            <img class="intLink" title="Borrar" onclick="if(validateMode()&amp;&amp;confirm('Quiere Reiniciar El Documento?')){oDoc.innerHTML=sDefTxt};" src="data:image/gif;base64,R0lGODlhFgAWAIQbAD04KTRLYzFRjlldZl9vj1dusY14WYODhpWIbbSVFY6O7IOXw5qbms+wUbCztca0ccS4kdDQjdTLtMrL1O3YitHa7OPcsd/f4PfvrvDv8Pv5xv///////////////////yH5BAEKAB8ALAAAAAAWABYAAAV84CeOZGmeaKqubMteyzK547QoBcFWTm/jgsHq4rhMLoxFIehQQSAWR+Z4IAyaJ0kEgtFoLIzLwRE4oCQWrxoTOTAIhMCZ0tVgMBQKZHAYyFEWEV14eQ8IflhnEHmFDQkAiSkQCI2PDC4QBg+OAJc0ewadNCOgo6anqKkoIQA7">
	                            <img class="intLink" title="Imprimir" onclick="printDoc();" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABYAAAAWCAYAAADEtGw7AAAABGdBTUEAALGPC/xhBQAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9oEBxcZFmGboiwAAAAIdEVYdENvbW1lbnQA9syWvwAAAuFJREFUOMvtlUtsjFEUx//n3nn0YdpBh1abRpt4LFqtqkc3jRKkNEIsiIRIBBEhJJpKlIVo4m1RRMKKjQiRMJRUqUdKPT71qpIpiRKPaqdF55tv5vvusZjQTjOlseUkd3Xu/3dPzusC/22wtu2wRn+jG5So/OCDh8ycMJDflehMlkJkVK7KUYN+ufzA/RttH76zaVocDptRxzQtNi3mRWuPc+6cKtlXZ/sddP2uu9uXlmYXZ6Qm8v4Tz8lhF1H+zDQXt7S8oLMXtbF4e8QaFHjj3kbP2MzkktHpiTjp9VH6iHiA+whtAsX5brpwueMGdONdf/2A4M7ukDs1JW662+XkqTkeUoqjKtOjm2h53YFL15pSJ04Zc94wdtibr26fXlC2mzRvBccEbz2kiRFD414tKMlEZbVGT33+qCoHgha81SWYsew0r1uzfNylmtpx80pngQQ91LwVk2JGvGnfvZG6YcYRAT16GFtW5kKKfo1EQLtfh5Q2etT0BIWF+aitq4fDbk+ImYo1OxvGF03waFJQvBCkvDffRyEtxQiFFYgAZTHS0zwAGD7fG5TNnYNTp8/FzvGwJOfmgG7GOx0SAKKgQgDMgKBI0NJGMEImpGDk5+WACEwEd0ywblhGUZ4Hw5OdUekRBLT7DTgdEgxACsIznx8zpmWh7k4rkpJcuHDxCul6MDsmmBXDlWCH2+XozSgBnzsNCEE4euYV4pwCpsWYPW0UHDYBKSWu1NYjENDReqtKjwn2+zvtTc1vMSTB/mvev/WEYSlASsLimcOhOBJxw+N3aP/SjefNL5GePZmpu4kG7OPr1+tOfPyUu3BecWYKcwQcDFmwFKAUo90fhKDInBCAmvqnyMgqUEagQwCoHBDc1rjv9pIlD8IbVkz6qYViIBQGTJPx4k0XpIgEZoRN1Da0cij4VfR0ta3WvBXH/rjdCufv6R2zPgPH/e4pxSBCpeatqPrjNiso203/5s/zA171Mv8+w1LOAAAAAElFTkSuQmCC">
	                            <img class="intLink" title="Undo" onclick="formatDoc('undo');" src="data:image/gif;base64,R0lGODlhFgAWAOMKADljwliE33mOrpGjuYKl8aezxqPD+7/I19DV3NHa7P///////////////////////yH5BAEKAA8ALAAAAAAWABYAAARR8MlJq7046807TkaYeJJBnES4EeUJvIGapWYAC0CsocQ7SDlWJkAkCA6ToMYWIARGQF3mRQVIEjkkSVLIbSfEwhdRIH4fh/DZMICe3/C4nBQBADs=">
	                            <img class="intLink" title="Redo" onclick="formatDoc('redo');" src="data:image/gif;base64,R0lGODlhFgAWAMIHAB1ChDljwl9vj1iE34Kl8aPD+7/I1////yH5BAEKAAcALAAAAAAWABYAAANKeLrc/jDKSesyphi7SiEgsVXZEATDICqBVJjpqWZt9NaEDNbQK1wCQsxlYnxMAImhyDoFAElJasRRvAZVRqqQXUy7Cgx4TC6bswkAOw==">
	                            <img class="intLink" title="Quitar Formato" onclick="formatDoc('removeFormat')" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABYAAAAWCAYAAADEtGw7AAAABGdBTUEAALGPC/xhBQAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAAOxAAADsQBlSsOGwAAAAd0SU1FB9oECQMCKPI8CIIAAAAIdEVYdENvbW1lbnQA9syWvwAAAuhJREFUOMtjYBgFxAB501ZWBvVaL2nHnlmk6mXCJbF69zU+Hz/9fB5O1lx+bg45qhl8/fYr5it3XrP/YWTUvvvk3VeqGXz70TvbJy8+Wv39+2/Hz19/mGwjZzuTYjALuoBv9jImaXHeyD3H7kU8fPj2ICML8z92dlbtMzdeiG3fco7J08foH1kurkm3E9iw54YvKwuTuom+LPt/BgbWf3//sf37/1/c02cCG1lB8f//f95DZx74MTMzshhoSm6szrQ/a6Ir/Z2RkfEjBxuLYFpDiDi6Af///2ckaHBp7+7wmavP5n76+P2ClrLIYl8H9W36auJCbCxM4szMTJac7Kza////R3H1w2cfWAgafPbqs5g7D95++/P1B4+ECK8tAwMDw/1H7159+/7r7ZcvPz4fOHbzEwMDwx8GBgaGnNatfHZx8zqrJ+4VJBh5CQEGOySEua/v3n7hXmqI8WUGBgYGL3vVG7fuPK3i5GD9/fja7ZsMDAzMG/Ze52mZeSj4yu1XEq/ff7W5dvfVAS1lsXc4Db7z8C3r8p7Qjf///2dnZGxlqJuyr3rPqQd/Hhyu7oSpYWScylDQsd3kzvnH738wMDzj5GBN1VIWW4c3KDon7VOvm7S3paB9u5qsU5/x5KUnlY+eexQbkLNsErK61+++VnAJcfkyMTIwffj0QwZbJDKjcETs1Y8evyd48toz8y/ffzv//vPP4veffxpX77z6l5JewHPu8MqTDAwMDLzyrjb/mZm0JcT5Lj+89+Ybm6zz95oMh7s4XbygN3Sluq4Mj5K8iKMgP4f0////fv77//8nLy+7MCcXmyYDAwODS9jM9tcvPypd35pne3ljdjvj26+H2dhYpuENikgfvQeXNmSl3tqepxXsqhXPyc666s+fv1fMdKR3TK72zpix8nTc7bdfhfkEeVbC9KhbK/9iYWHiErbu6MWbY/7//8/4//9/pgOnH6jGVazvFDRtq2VgiBIZrUTIBgCk+ivHvuEKwAAAAABJRU5ErkJggg==">
	                            <img class="intLink" title="Negrita" onclick="formatDoc('bold');" src="data:image/gif;base64,R0lGODlhFgAWAID/AMDAwAAAACH5BAEAAAAALAAAAAAWABYAQAInhI+pa+H9mJy0LhdgtrxzDG5WGFVk6aXqyk6Y9kXvKKNuLbb6zgMFADs=">
	                            <img class="intLink" title="Inclinado" onclick="formatDoc('italic');" src="data:image/gif;base64,R0lGODlhFgAWAKEDAAAAAF9vj5WIbf///yH5BAEAAAMALAAAAAAWABYAAAIjnI+py+0Po5x0gXvruEKHrF2BB1YiCWgbMFIYpsbyTNd2UwAAOw==">
	                            <img class="intLink" title="Subrayado" onclick="formatDoc('underline');" src="data:image/gif;base64,R0lGODlhFgAWAKECAAAAAF9vj////////yH5BAEAAAIALAAAAAAWABYAAAIrlI+py+0Po5zUgAsEzvEeL4Ea15EiJJ5PSqJmuwKBEKgxVuXWtun+DwxCCgA7">
	                            <img class="intLink" title="Alinear izquierda" onclick="formatDoc('justifyleft');" src="data:image/gif;base64,R0lGODlhFgAWAID/AMDAwAAAACH5BAEAAAAALAAAAAAWABYAQAIghI+py+0Po5y02ouz3jL4D4JMGELkGYxo+qzl4nKyXAAAOw==">
	                            <img class="intLink" title="Alinear medio" onclick="formatDoc('justifycenter');" src="data:image/gif;base64,R0lGODlhFgAWAID/AMDAwAAAACH5BAEAAAAALAAAAAAWABYAQAIfhI+py+0Po5y02ouz3jL4D4JOGI7kaZ5Bqn4sycVbAQA7">
	                            <img class="intLink" title="Alinear Derecha" onclick="formatDoc('justifyright');" src="data:image/gif;base64,R0lGODlhFgAWAID/AMDAwAAAACH5BAEAAAAALAAAAAAWABYAQAIghI+py+0Po5y02ouz3jL4D4JQGDLkGYxouqzl43JyVgAAOw==">
	                            <img class="intLink" title="Lista numero" onclick="formatDoc('insertorderedlist');" src="data:image/gif;base64,R0lGODlhFgAWAMIGAAAAADljwliE35GjuaezxtHa7P///////yH5BAEAAAcALAAAAAAWABYAAAM2eLrc/jDKSespwjoRFvggCBUBoTFBeq6QIAysQnRHaEOzyaZ07Lu9lUBnC0UGQU1K52s6n5oEADs=">
	                            <img class="intLink" title="Lista Punto" onclick="formatDoc('insertunorderedlist');" src="data:image/gif;base64,R0lGODlhFgAWAMIGAAAAAB1ChF9vj1iE33mOrqezxv///////yH5BAEAAAcALAAAAAAWABYAAAMyeLrc/jDKSesppNhGRlBAKIZRERBbqm6YtnbfMY7lud64UwiuKnigGQliQuWOyKQykgAAOw==">
	                            <img class="intLink" title="Salto y Tabulador" onclick="formatDoc('formatblock','blockquote');" src="data:image/gif;base64,R0lGODlhFgAWAIQXAC1NqjFRjkBgmT9nqUJnsk9xrFJ7u2R9qmKBt1iGzHmOrm6Sz4OXw3Odz4Cl2ZSnw6KxyqO306K63bG70bTB0rDI3bvI4P///////////////////////////////////yH5BAEKAB8ALAAAAAAWABYAAAVP4CeOZGmeaKqubEs2CekkErvEI1zZuOgYFlakECEZFi0GgTGKEBATFmJAVXweVOoKEQgABB9IQDCmrLpjETrQQlhHjINrTq/b7/i8fp8PAQA7">
	                            <img class="intLink" title="Quitar Tabulador" onclick="formatDoc('outdent');" src="data:image/gif;base64,R0lGODlhFgAWAMIHAAAAADljwliE35GjuaezxtDV3NHa7P///yH5BAEAAAcALAAAAAAWABYAAAM2eLrc/jDKCQG9F2i7u8agQgyK1z2EIBil+TWqEMxhMczsYVJ3e4ahk+sFnAgtxSQDqWw6n5cEADs=">
	                            <img class="intLink" title="Agregar Tabulador" onclick="formatDoc('indent');" src="data:image/gif;base64,R0lGODlhFgAWAOMIAAAAADljwl9vj1iE35GjuaezxtDV3NHa7P///////////////////////////////yH5BAEAAAgALAAAAAAWABYAAAQ7EMlJq704650B/x8gemMpgugwHJNZXodKsO5oqUOgo5KhBwWESyMQsCRDHu9VOyk5TM9zSpFSr9gsJwIAOw==">
	                            <img class="intLink" title="Cortar" onclick="formatDoc('cut');" src="data:image/gif;base64,R0lGODlhFgAWAIQSAB1ChBFNsRJTySJYwjljwkxwl19vj1dusYODhl6MnHmOrpqbmpGjuaezxrCztcDCxL/I18rL1P///////////////////////////////////////////////////////yH5BAEAAB8ALAAAAAAWABYAAAVu4CeOZGmeaKqubDs6TNnEbGNApNG0kbGMi5trwcA9GArXh+FAfBAw5UexUDAQESkRsfhJPwaH4YsEGAAJGisRGAQY7UCC9ZAXBB+74LGCRxIEHwAHdWooDgGJcwpxDisQBQRjIgkDCVlfmZqbmiEAOw==">
	                            <img class="intLink" title="Copiar" onclick="formatDoc('copy');" src="data:image/gif;base64,R0lGODlhFgAWAIQcAB1ChBFNsTRLYyJYwjljwl9vj1iE31iGzF6MnHWX9HOdz5GjuYCl2YKl8ZOt4qezxqK63aK/9KPD+7DI3b/I17LM/MrL1MLY9NHa7OPs++bx/Pv8/f///////////////yH5BAEAAB8ALAAAAAAWABYAAAWG4CeOZGmeaKqubOum1SQ/kPVOW749BeVSus2CgrCxHptLBbOQxCSNCCaF1GUqwQbBd0JGJAyGJJiobE+LnCaDcXAaEoxhQACgNw0FQx9kP+wmaRgYFBQNeAoGihCAJQsCkJAKOhgXEw8BLQYciooHf5o7EA+kC40qBKkAAAGrpy+wsbKzIiEAOw==">
	                            <img class="intLink" title="Pegar" onclick="formatDoc('paste');" src="data:image/gif;base64,R0lGODlhFgAWAIQUAD04KTRLY2tXQF9vj414WZWIbXmOrpqbmpGjudClFaezxsa0cb/I1+3YitHa7PrkIPHvbuPs+/fvrvv8/f///////////////////////////////////////////////yH5BAEAAB8ALAAAAAAWABYAAAWN4CeOZGmeaKqubGsusPvBSyFJjVDs6nJLB0khR4AkBCmfsCGBQAoCwjF5gwquVykSFbwZE+AwIBV0GhFog2EwIDchjwRiQo9E2Fx4XD5R+B0DDAEnBXBhBhN2DgwDAQFjJYVhCQYRfgoIDGiQJAWTCQMRiwwMfgicnVcAAAMOaK+bLAOrtLUyt7i5uiUhADs=">
	                            <hr>
	                        </div>

	                        <form hidden name="compForm" method="post" action="sample.php" onsubmit="if(validateMode()){this.myDoc.value=oDoc.innerHTML;return true;}return false;">
	                            <p id="editMode"><input type="checkbox" name="switchMode" id="switchBox" onchange="setDocMode(this.checked);" /> <label for="switchBox">Ver Codigo HTML</label></p>
	                        </form>
	                        <style>
	                            div#textBox p {
	                                margin-top: 0px;
	                                margin-bottom: 0px;
	                            }

	                            div#textBox blockquote {
	                                font-size: 12px;
	                                padding-top: 0px;
	                                padding-bottom: 0px;
	                                margin: 0 0 0 40px;
	                                border: none;
	                            }
	                        </style>
	                        <div id="textBox" value="innerHTML" contenteditable="true" style="border-color: black;border-style: dotted;min-height: 279px;">
	                            <p style="font-size: 12px;">Edite Su Carta Documento Aquí</p>
	                        </div>
	                    </div>
	                </div>

	                <!-- CONTENT EDITABLE -->

	                <div class="row mt-4 p-4" style="border-color: #292d57;border-style: double;color: #292d57;">
	                    <div class="col-12">
	                        <h4 class="font-weight-bold text-uppercase">Guardar En Mis Plantillas</h4>
	                    </div>
	                    <div class="col-12">
	                        <div class="form-group">
	                            <label for="NombreDeFormulario">Ingrese el nombre de la nueva plantilla</label>
	                            <input type="text" name="NombreDeFormulario" id="NombreDeFormulario" class="form-control" placeholder="Ingrese el nombre de su nueva plantilla">
	                        </div>
	                        <div class="form-group">
	                            <button class="btn btn-primary d-block" onclick="validarCrearPlantilla()">Guardar Plantilla</button>
	                            <small class="small text-black-50">Al Guardar Este Formulario Sera Visible Solo En Su Cuenta</small>
	                        </div>
	                    </div>
	                    <div class="col-12">
	                        <h4 class="font-weight-bold text-uppercase">Editar O Borrar Mi Plantilla</h4>
	                    </div>
	                    <div class="col-12 col-md-6">
	                        <div class="form-group">
	                            <button class="btn btn-warning text-white" onclick="validarEditarPlantilla()">Editar Plantilla</button>
	                        </div>
	                    </div>
	                    <div class="col-12 col-md-6">
	                        <div class="form-group">
	                            <button class="btn btn-danger" onclick="validarEliminarPlantilla()">Eliminar Plantilla</button>
	                        </div>
	                    </div>
	                </div>

	                <?php
                    echo ('<hr class="size2 hideline">');
                    echo ('<hr class="size2 hideline">');
                    echo ('<hr class="size2 hideline">');
                    echo ('<hr class="size2 hideline">');
                    echo ('<hr class="size2 hideline">');
                    ?>

	            </div>
	        </div>
	    </div>
	</div>



	<img id="imgBase" src="BasePDF.jpg" alt="Smiley face" height="auto" width="auto" hidden>
	<div hidden>
	    <canvas id="canvas" height="200px" width="auto"></canvas>
	</div>
	<?php

    echo ('<hr class="size2 hideline">');


    ?>

	<script>
	    function mostrarError(msj) {
	        const alertError = `
                    <div class="alert alert-danger alert-dismissible fade show alert-centrado" role="alert" id="alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        ${msj} 
                    </div>
                `

	        setTimeout(() => {
	            document.getElementById('alert-danger').remove();
	        }, 1500);

	        document.getElementById('body').insertAdjacentHTML('afterbegin', alertError)
	    }

	    function validarCrearPlantilla() {
	        if (!$("#NombreDeFormulario").val().trim().length > 0) {
	            mostrarError("Ingrese el nombre de la nueva plantilla")
	            $("#NombreDeFormulario").focus()
	            return;
	        }

	        GuardarFormulario();
	    }

	    function validarEditarPlantilla() {
	        if (!$("#custom-select-input").val().trim().length > 0) {
	            mostrarError("Seleccione la plantilla que desea editar")
	            $("#custom-select-input").focus()
	            return;
	        }

	        EditarFormulario();
	    }

	    function validarEliminarPlantilla(params) {
	        if (!$("#custom-select-input").val().trim().length > 0) {
	            mostrarError("Seleccione la plantilla que desea eliminar")
	            $("#custom-select-input").focus()
	            return;
	        }

	        EliminarFormulario();
	    }
	</script>




























































	<style>
	    body {
	        font-family: sans-serif;
	        background: #eeeeee;
	    }

	    .wrapper {
	        margin: 1em auto;
	        text-align: left;
	    }

	    .sample {
	        border: 1px solid #eeeeee;
	        background: #ffffff;
	        max-width: 30em;
	        padding: 1em;
	        margin-bottom: 1em;
	    }

	    .custom-select {
	        position: relative;
	    }

	    .select-css {
	        display: block;
	        font-size: 1em;
	        font-family: sans-serif;
	        font-weight: 700;
	        color: #444;
	        line-height: 1.3;
	        padding: .6em 1.4em .5em .8em;
	        width: 100%;
	        max-width: 100%;
	        box-sizing: border-box;
	        margin: 0;
	        border: 1px solid #aaa;
	        box-shadow: 0 1px 0 1px rgba(0, 0, 0, .04);
	        border-radius: .25em;
	        -moz-appearance: none;
	        -webkit-appearance: none;
	        appearance: none;
	        background-color: #fff;
	        position: relative;
	        z-index: 10;
	    }

	    .select-css::-ms-expand {
	        display: none;
	    }

	    .select-css:hover {
	        border-color: #888;
	    }

	    .select-css:focus {
	        //border: 2px dashed blue; 
	        color: #222;
	        outline: none;
	    }

	    .custom-select-icons {
	        position: absolute;
	        top: 0.5em;
	        right: 0.5em;
	        z-index: 20;
	        border: 1px solid white;
	        background: transparent;
	    }

	    .custom-select-options {
	        border: 1px solid #0068a9;
	        /* border-radius: 0 0 0.5em .5em!important; */
	        /* line-height: 0.0; */
	        margin: 0;
	        /* margin-top: -0.5em; */
	        padding: 0;
	        list-style-type: none;
	        font-weight: normal;
	        cursor: pointer;
	        z-index: 2;
	        position: absolute;
	        width: calc(100% - 1px);
	        background-color: #ffffff;
	    }

	    .custom-select-options li {
	        padding: 1px;
	        font-size: 8px;
	    }

	    .custom-select-options li:hover {
	        background: blue;
	        color: #fff;
	        border: 1px solid blue;
	        border-width: 0 0 0 1px;
	    }

	    .custom-select-options li:focus {
	        border: 2px blue;
	    }

	    .icon {
	        fill: ButtonText;
	        pointer-events: none;
	    }

	    @media screen and (-ms-high-contrast: active) {
	        .icon {
	            fill: ButtonText;
	        }
	    }

	    .hidden-all {
	        display: none;
	    }

	    .hidden-visually {
	        position: absolute;
	        width: 1px;
	        height: 1px;
	        padding: 0;
	        overflow: hidden;
	        clip: rect(0, 0, 0, 0);
	        white-space: nowrap;
	        -webkit-clip-path: inset(50%);
	        clip-path: inset(50%);
	        border: 0;
	    }
	</style>