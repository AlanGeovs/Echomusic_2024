<?php 
    include './includes/header.php';
?>
        <div class="row justify-content-md-center ">
            <div class="col-lg-8 col-md-8">
                <div class="content">
                    <h2 class="text-center">3 - Reservación (API WooC)</h2>
                    <form id="form2"  name="form2" method="GET" action="RESERVACION-pago.php"> 
                        <div class="row justify-content-md-center">
                            <div class="col-lg-4 col-sm-6">
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
                            </div> 


                            <div class="col-lg-4 col-sm-6">
                                <div class="form12-group">
                                    <label>Tipo de Servicio</label>
                                    <select  name="car" id="car" class="form-control"  data-error="Selecciona servicio"  required  /> 
                                    <option value="">Selecciona servicio</option>
                                    <option value="ligera">Carga Ligera</option>
                                    <option value="pesada">Carga Pesada</option> 
                                    </select>
                                </div>
                            </div>                             

                            <div class="col-lg-6 col-sm-6">                                        
                                <div class="form-group">
                                    <label>Fecha de entrega</label> 
                                    <input type="datetime-local" id="fi" name="fi" data-error="Selecciona la fecha inicial" value=" " class="form-control" placeholder="Fecha inicial" required />
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="help-block texto-fechas" style=""> </div>
                            </div>

                            <div class="col-lg-6 col-sm-6">
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

