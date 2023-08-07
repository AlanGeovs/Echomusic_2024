<?php 
    include './includes/header.php';
//    Recibo por GET si es ligero o carga
    $tipoCarga = $_GET['c'];
    
    if( empty($tipoCarga) ){
        $visibilidadDivTipoCarga = "";
        $selected = "";
        $columnas = 'col-lg-4  col-sm-4 ';    
        $columnasInv = 'col-lg-4  col-sm-4 ';    
           
        
    }else{
        $visibilidadDivTipoCarga = ' style="display: none;"';
        $selected = "selected";
        $columnas = 'col-lg-6  col-sm-6 ';
        $columnasInv = ' '; 
    }
    
?>
        <div class="row justify-content-md-center ">
            <div class="col-lg-11 col-md-11">
                <div class="content">
<!--                    <h2 class="text-center">Cotiza tu servicio</h2>  -->
                    <form id="form2"  name="form2" method="POST" action="RESERVACION-POST-redirecciona-a-producto.php"  target="_blank"> 
                        <div class="row justify-content-md-center">
<!--                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control" id="n" name="n" required data-error="Nombre" placeholder="Nombre"  required   />
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group">
                                    <label>Correo</label>
                                    <input type="text" class="form-control" id="c" name="c" required data-error="Correo" placeholder="Correo"  required   />
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div> -->
<!--                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group">
                                    <label>Dias de reserva</label>
                                    <input type="number" class="form-control" id="quantity_64b9f62a880c6" name="quantity" required data-error="Correo" placeholder="Correo"  required   />
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>  -->


                            <div class="<?php echo $columnasInv; ?>" <?php echo $visibilidadDivTipoCarga; ?>>
                                <div class="form12-group">
                                    <label>Tipo de Servicio</label>
                                    <select  name="car" id="car" class="form-control"  data-error="Selecciona servicio"  required  /> 
                                    
                                    <?php  
                                        if($tipoCarga == 'ligera'){
                                            echo '<option value="">Selecciona servicio</option>
                                                  <option value="ligera" '.$selected.'>Carga Ligera</option>
                                                  <option value="pesada">Carga Pesada</option> ';
                                        }
                                        if($tipoCarga == 'pesada'){
                                            echo '<option value="">Selecciona servicio</option>
                                                  <option value="ligera">Carga Ligera</option>
                                                  <option value="pesada" '.$selected.'>Carga Pesada</option> ';
                                        }
                                        if($tipoCarga == ''){
                                            echo '<option value=""  '.$selected.'>Selecciona servicio</option>
                                                  <option value="ligera">Carga Ligera</option>
                                                  <option value="pesada">Carga Pesada</option> ';
                                        }
                                        
                                    
                                    ?>
                                    
                                    </select>
                                </div>
                            </div>                             

                            <div class="<?php echo $columnas; ?>">                                        
                                <div class="form-group">
                                    <label>Fecha de entrega</label> 
                                    <input type="datetime-local" id="fi" name="fi" data-error="Selecciona la fecha inicial" value=" " class="form-control" placeholder="Fecha inicial" required />
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="help-block texto-fechas" style=""> </div>
                            </div>

                            <div class="<?php echo $columnas; ?>">
                                <div class="form-group">
                                    <label>Fecha de devolución</label>
                                    <input type="datetime-local" id="ff" name="ff" data-error="Selecciona la fecha final" value=" " class="form-control" placeholder="Fecha final" required />
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="help-block texto-fechas" style=""> </div>
                            </div>


                            <div class="col-lg-12 col-md-12 text-center "> 
                                <button type="submit" class="btn btn-lodela"> 
                                    ¡Cotizar ahora!
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div> 
        </div>      

<?php 
    include './includes/footer.php';
?>

