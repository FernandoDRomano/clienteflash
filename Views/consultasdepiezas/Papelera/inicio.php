<body id="page-top">
<?php include 'h_barra.php'; ?>
  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Begin Page Content -->
      <div class="container-fluid">
      <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Auditorías del día</h1>
       <?php
         if(isset($datos)){
           $filas = mysqli_num_rows($datos);
           if ($filas == 0) {
      ?>
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="form-group">
          <div class="form-row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <div class="form-label-group">
                <div class="alert alert-danger" align="center">
                  <small>No se encontraron auditorías realizadas el día de hoy.</small>
                </div>
              </div>
            </div>
            <?php }?>
            </div>
            </div>
            </div>
            <?php if ($filas > 0) {?>
            <div class="table-responsive">
              <table id="auditoriasrealizadas" name="auditoriasrealizadas" class="table table-bordered col-mb-12">
              <thead>
                <tr style="background-color: #ffad88">
                  <td><center><strong>Hora</strong></center></td>
                  <td><center><strong>Local</strong></center></td>
                  <td><center><strong>Mal</strong></center></td>
                  <td><center><strong>Intermedio</strong></center></td>
                  <td><center><strong>Bien</strong></center></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>                                
                </tr>
              </thead>
              <tbody id="tabla" name="tabla">
              <?php 
                while ( $row = mysqli_fetch_array($datos)){
                  $idformulario[] = $row['idformulario'];
                  $idlocal[] = $row['loc_nombre'];
                  $idfor_horacom[] = $row['for_horacom'];
                  $resp_nombre[] = $row['resp_nombre'];
                  $idrespuesta[] = $row['idrespuesta'];
                  if($row['idrespuesta'] == 1){
                    $mal[] = $row['items'];
                  }
                  if($row['idrespuesta'] == 2){
                    $intermedio[] = $row['items'];
                  }
                  if($row['idrespuesta'] == 3){
                    $bien[] = $row['items'];
                  }
                  $respuesta[] = $row['items'];
                }
                $count = count($idformulario);
                for($i=0;$i<$count;$i++){
                  if($i == 0){
                    $cont = 0;
                    $formulario[$cont] = $idformulario[$i];
                    $local[$cont] = $idlocal[$i];
                    $for_horacom[$cont] = $idfor_horacom[$i];
                  }else{
                    if($idformulario[$i] != $idformulario[$i-1]){
                      $cont = $cont + 1;
                      $formulario[$cont] = $idformulario[$i];
                      $local[$cont] = $idlocal[$i];
                      $for_horacom[$cont] = $idfor_horacom[$i];
                    }
                  }
                }
                $filas = count($formulario);
                for($i=0;$i<$filas;$i++){ ?>       
              <tr bgcolor="#fffaeb">
                <td id="hora"><?php echo $for_horacom[$i]; ?></td>
                <td id="local"><?php echo $local[$i]; ?></td>
                <td id="mal"><?php echo $mal[$i]; ?></td>
                <td id="masomenos"><?php echo $intermedio[$i]; ?></td>
                <td id="bien"><?php echo $bien[$i]; ?></td>
                <td align=center>
                  <a href="<?php echo URL; ?>informes/form_terminado/<?php echo $formulario[$i]; ?>" class="btn btn-primary btn-md" data-toggle="tooltip" data-placement="top" title="Respuestas"><i class="far fa-eye"></i></a></td>
                <td align=center>
                  <a href="<?php echo URL; ?>informes/por_auditoria/<?php echo $formulario[$i]; ?>" class="btn btn-primary btn-md" data-toggle="tooltip" data-placement="top" title="Informe"><i class="fas fa-chart-line"></i></a></td>
                <td align=center>
                  <a href="<?php echo URL; ?>informes/multimedia/<?php echo $formulario[$i]; ?>" class="btn btn-primary btn-md" data-toggle="tooltip" data-placement="top" title="Ver imagenes y observaciones"><i class="fas fa-images"></i></a></td>
                <td align=center>
                  <a data-toggle="modal" href="#eliminar" data-target="#eliminarModalCenter<?php echo $formulario[$i]; ?>" id="<?php echo $formulario[$i]; ?>" class="btn btn-primary btn-md"><i class="fas fa-trash-alt" data-toggle="tooltip" data-placement="top" title="Eliminar"></i></a>
                </td>
              <!-- el id del modal debe ser el mismo que el data target del boton-->
              <div class="modal fade" id="eliminarModalCenter<?php echo $formulario[$i];?>" tabindex="-1" role="dialog" aria-labelledby="eliminarModalCenterTitle" aria-hidden="true"> 
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="eliminarModalLongTitle">Eliminar</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>¿Desea eliminar el formulario?</p>         
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <a href="<?php echo URL; ?>auditoria/eliminar/<?php echo $row['idformulario'] ; ?>" class="btn btn-primary">Eliminar</a>
                      </div>
                    </div>
                  </div>
                </div>  
            <div class="modal fade" id="desbloquearModalCenter<?php echo $formulario[$i];?>" tabindex="-1" role="dialog" aria-labelledby="eliminarModalCenterTitle" aria-hidden="true"> 
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="desbloquearModalCenter">Desbloquear</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>¿Desea desbloquear el usuario <b> <?php echo $row['us_name'];?> </b> ?</p>         
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <a href="<?php echo URL; ?>usuario/desbloquear/<?php echo $row['idformulario'] ; ?>" class="btn btn-primary">Desbloquear</a>
                </div>
              </div>
            </div>
          </div>                            
          <?php }?>
        </tr>                      
      </tbody>
    </table>
    <?php }}else{?>
    </div>
  </div>
  <?php } ?>   
  </div>

<!-- /.container-fluid -->
</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
 <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
</body>
</html>
