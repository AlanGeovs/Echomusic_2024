<?php
session_start();
require_once "model/model.php";

if(!isset($_SESSION["idUser"])){
    header("Location: index.php?error=2");
}else{


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php    require  'includes/favicon.php'; ?> 
    <title>Admin | AutoMayoreo</title>
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/app.css">

    <style>

        #imgSlide{
            position:relative;
        }

        #imgSlide p{
            position:relative;
            text-align:center;
            width:100%;
            margin-top:10px;
        }

        #imgSlide ul{
            position: relative;
            margin:20px;
            padding: 0px 10px;
            /*height:auto;*/
            border:2px dashed #999;
        }

        #imgSlide ul li span{
            position:absolute;
            top:0;
            right:0;
            cursor:pointer;
            width:30px;
            height:30px;
            text-align:center;
            line-height:30px;
            background:white;
            z-index:1;
            color:white;
            background: red;
        }
    </style>

</head>
<body class="light sidebar-mini sidebar-collapse">
<!-- Pre loader -->
<div id="loader" class="loader">
    <div class="plane-container">
        <div class="preloader-wrapper small active">
            <div class="spinner-layer spinner-blue">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>

            <div class="spinner-layer spinner-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>

            <div class="spinner-layer spinner-yellow">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>

            <div class="spinner-layer spinner-green">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>
        </div>
    </div>
</div>
<div id="app">
    <?php include "menu.php"; ?>
    <div class="container-fluid animatedParent animateOnce my-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body b-b">
                        <h4>Registrar Auto</h4>
                        <form method="post" action="includes/registrarInventario_db.php" class="form-material">
                            <div class="row">
                                <input type="hidden" id="idUsuario" name="idUsuario" value="<?php echo $_SESSION['idUser']; ?>">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label for="car_id">ID</label>
                                            <input type="text" class="form-control" id="car_id" name="car_id" placeholder="AM00XXX" required>
                                        </div> 
                                        <div class="col-md-3 mb-3">
                                            <label for="asociado">Asociado</label>   
                                            <select name="asociado" id="asociado" class="form-control" >
                                                <?php
                                                $respuesta = Consultas::listarAsociados();
                                                //var_dump($respuesta);

                                                for ($i = 0; $i < count($respuesta); $i++) {
                                                    //echo '<input type="checkbox" id="clase'.$respuesta[$i]["ID"].'" name="clases[]" value="'.$respuesta[$i]["ID"].'">';
                                                    //echo '<label for="clase'.$respuesta[$i]["ID"].'">'.$respuesta[$i]["TAG"].'</label>  ';
                                                    echo "<option id='asociado' name='asociado' value='" . $respuesta[$i]["id"] . "'>  " . ($i + 1) . " - " . $respuesta[$i]["usuario"] . "</option>";
                                                }
                                                ?>    
                                            </select>                                        
                                            
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="condicion">Condición</label> 
                                                <select name="condicion" id="condicion" class="form-control" > 
                                                    <option id='condicion' name='condicion' value="usado" selected> Usado</option>                                
                                                    <option id='condicion' name='condicion' value="nuevo"> Nuevo</option>  
                                                </select>
                                            
                                             
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="tipo">Tipo</label> 
                                                <select name="tipo" id="tipo" class="form-control" >  
                                                    <option id='tipo' name='tipo' value="">Selecciona</option> 
                                                    <option id='tipo' name='tipo' value="Sedan"> Sedan</option>                                
                                                    <option id='tipo' name='tipo' value="SUV"> SUV</option>                                
                                                    <option id='tipo' name='tipo' value="Hatchback"> Hatchback</option>                                
                                                    <option id='tipo' name='tipo' value="Pickup"> Pickup</option>                                
                                                    <option id='tipo' name='tipo' value="VAN"> VAN</option>                                
                                                    <option id='tipo' name='tipo' value="Moto"> Moto</option>                                
                                                    <option id='tipo' name='tipo' value="Coupe"> Coupe</option>   
                                                </select>
                                            
                                             
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label for="marca">Marca</label>
                                            <input type="text" class="form-control" id="marca" name="marca" placeholder="Marca" >
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="modelo">Modelo</label>
                                            <input type="text" class="form-control" id="modelo" name="modelo" placeholder="Modelo" >
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="version">Versión</label>
                                            <input type="text" class="form-control" id="version" name="version" placeholder="Versión" >                                            
                                        </div> 
                                        <div class="col-md-3 mb-3">
                                            <label for="ano">Año</label>
                                            <input type="text" class="form-control" id="ano" name="ano" placeholder="Año" >                                            
                                        </div> 
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label for="precio">Precio</label>
                                            <div class="input-group-prepend">
                                                    <div class="input-group-prepend"> 
                                                        <span class="input-group-text" id="inputGroupPrepend">$</span>
                                                    </div> 
                                                    <input type="text" class="form-control" id="precio" name="precio" placeholder="290,000" >                                            
                                                </div>
                                        </div> 
                                        <div class="col-md-3 mb-3">
                                            <label for="transmision">Transmisión</label>
                                            <select name="transmision" id="transmision" class="form-control" >  
                                                     <option id='transmision' name='transmision' value="">Selecciona</option> 
                                                     <option id='transmision' name='transmision' value="automatico"> Automático</option>                                
                                                     <option id='transmision' name='transmision' value="manual"> Manual</option>  
                                                </select>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                                <label for="combustible">Combustible</label>
                                                <select name="combustible" id="combustible" class="form-control" >  
                                                    <option id='combustible' name='combustible' value="">Selecciona</option>  
                                                    <option id='combustible' name='combustible' value="gasolina" selected> Gasolina</option>                                
                                                    <option id='combustible' name='combustible' value="electrico"> Eléctrico</option>                                
                                                    <option id='combustible' name='combustible' value="hibrido"> Híbrido</option>                                
                                                    <option id='combustible' name='combustible' value="diesel"> Diesel</option>   
                                                </select>
                                            </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="kilometraje">Kilometraje</label>
                                            <input type="text" class="form-control" id="kilometraje" name="kilometraje" placeholder="Kilometraje">
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label for="color_int">Color Interior</label>
                                            <input type="text" class="form-control" id="color_int" name="color_int" placeholder="Color Interior">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="color_ext">Color Exterior</label>
                                            <input type="text" class="form-control" id="color_ext" name="color_ext" placeholder="Color Exterior">
                                            
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="tam_motor">Tamaño motor</label>
                                            <input type="text" class="form-control" id="tam_motor" name="tam_motor" placeholder="Tamaño motor">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="cilindros">Cilindros</label>
                                            <input type="text" class="form-control" id="cilindros" name="cilindros" placeholder="Cilindros"> 
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="note">Detalles</label>
                                            <textarea class="form-control r-0" id="note" name="note" rows="5" ></textarea>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="observaciones">Observaciones</label>
                                            <textarea class="form-control r-0" id="observaciones" name="observaciones" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div id="imgSlide" class="row col-12">
                                        <p><span class="icon-arrow_downward"></span>  Arrastra aquí tu imagen, tamaño recomendado: 1600px * 600px</p>
        
                                        <ul id="columnasSlide" class="col-12">   
                                            
                                        </ul>
                                        <textarea name="datosImagen" id="datosImagen" style="display: none;"></textarea>
                                    </div>
                                </div>   
                            </div>
                            <button class="btn btn-primary waves-effect" type="submit">Guardar</button>
                            <button class="btn btn-danger waves-effect" type="reset">Limpiar</button>
                        </form>
                        <?php

                        if (@$_GET["e"]=="error") {
                            echo "<div class='alert alert-danger'>Hubo un error al guardar datos...</div>";
                        }

                        ?>
                    </div><!--termina .card-body -->
                </div><!--termina .card -->
            </div><!-- termina .col-md-12 -->
        </div><!-- termina .row -->
        </div>
    </div>
</div>
<!-- Right Sidebar -->
<aside class="control-sidebar fixed white ">
    <div class="slimScroll">
        <div class="sidebar-header">
            <h4>Bitácora</h4>
            <a href="#" data-toggle="control-sidebar" class="paper-nav-toggle  active"><i></i></a>
        </div>
        <div class="p-3">
           <!-- The time line -->
           <ul class="timeline">
            <?php
            $hoyCorto=date("Y-m-d");
            $hoyFin=date("Y-m-d")." 23:59:59";
            $hoyInicio=date("Y-m-d")." 00:00:00";

            $fechas=Consultas::bitacoraFechas("bitacora");
            $respuesta=Consultas::bitacora("bitacora");
            for ($j=0; $j < 3; $j++) { 
                if ($fechas[$j]["fechas"]==$hoyCorto) {
                    //<!-- timeline time label -->
                    echo '<li class="time-label">
                        <span class="badge badge-danger r-3">
                            Hoy
                        </span>
                    </li>';
                   //<!-- /.timeline-label -->
                    for ($i=0; $i < count($respuesta); $i++) {
                        if ($respuesta[$i]["fecha"]<=$hoyFin && $respuesta[$i]["fecha"]>=$hoyInicio) {  
                            if (preg_match("/Inici\b/", $respuesta[$i]["accion"])) {
                               //<!-- timeline item -->
                                echo '<li>
                                    <i class="ion icon-sign-in bg-primary"></i>
                                    <div class="timeline-item card">
                                        <div class="card-header white"><h6>'.$respuesta[$i]["usuario"].' '.$respuesta[$i]["accion"].'    <span class="time float-right"><i class="ion icon-clock-o"></i> '.substr($respuesta[$i]["fecha"],11).'</span></h6></div>
                                    </div>
                                </li>';
                                //<!-- END timeline item -->
                            }elseif(preg_match("/Registr\b/", $respuesta[$i]["accion"])) {
                                //<!-- timeline item -->
                                echo '<li>
                                    <i class="ion icon-plus-circle bg-success"></i>
                                    <div class="timeline-item card">
                                        <div class="card-header white"><h6>'.$respuesta[$i]["usuario"].' '.$respuesta[$i]["accion"].'    <span class="time float-right"><i class="ion icon-clock-o"></i> '.substr($respuesta[$i]["fecha"],11).'</span></h6></div>
                                    </div>
                                </li>';
                                //<!-- END timeline item -->
                            }elseif(preg_match("/Elimin\b/", $respuesta[$i]["accion"])){
                                echo '<li>
                                    <i class="ion icon-trash bg-danger"></i>
                                    <div class="timeline-item card">
                                        <div class="card-header white"><h6>'.$respuesta[$i]["usuario"].' '.$respuesta[$i]["accion"].'    <span class="time float-right"><i class="ion icon-clock-o"></i> '.substr($respuesta[$i]["fecha"],11).'</span></h6></div>
                                    </div>
                                </li>';
                            }elseif(preg_match("/Modific\b/", $respuesta[$i]["accion"])){
                                echo '<li>
                                    <i class="ion icon-mode_edit bg-warning"></i>
                                    <div class="timeline-item card">
                                        <div class="card-header white"><h6>'.$respuesta[$i]["usuario"].' '.$respuesta[$i]["accion"].'    <span class="time float-right"><i class="ion icon-clock-o"></i> '.substr($respuesta[$i]["fecha"],11).'</span></h6></div>
                                    </div>
                                </li>';
                            } 
                        }
                        
                    }
                }else{
                    $date1 = new DateTime($fechas[$j]["fechas"]);
                    //var_dump($date1);
                    $date2 = new DateTime("now");
                    $diff = $date1->diff($date2);
                    //<!-- timeline time label -->
                    echo '<li class="time-label">
                        <span class="badge badge-danger r-3">
                            Hace '.$diff->days.' día(s)
                        </span>
                    </li>';
                    //<!-- /.timeline-label --> 

                    for ($i=0; $i < count($respuesta); $i++) {
                        //echo substr($respuesta[$i]["fecha"],0,10);
                        if ($diff->days!=0 && substr($respuesta[$i]["fecha"],0,10)==$fechas[$j]["fechas"]) {
                            
                            if (preg_match("/Inici\b/", $respuesta[$i]["accion"])) {
                               //<!-- timeline item -->
                                echo '<li>
                                    <i class="ion icon-sign-in bg-primary"></i>
                                    <div class="timeline-item card">
                                        <div class="card-header white"><h6>'.$respuesta[$i]["usuario"].' '.$respuesta[$i]["accion"].'    <span class="time float-right"><i class="ion icon-clock-o"></i> '.fechaHora($respuesta[$i]["fecha"]).'</span></h6></div>
                                    </div>
                                </li>';
                                //<!-- END timeline item -->
                            }elseif(preg_match("/Registr\b/", $respuesta[$i]["accion"])) {
                                //<!-- timeline item -->
                                echo '<li>
                                    <i class="ion icon-plus-circle bg-success"></i>
                                    <div class="timeline-item card">
                                        <div class="card-header white"><h6>'.$respuesta[$i]["usuario"].' '.$respuesta[$i]["accion"].'    <span class="time float-right"><i class="ion icon-clock-o"></i> '.fechaHora($respuesta[$i]["fecha"]).'</span></h6></div>
                                    </div>
                                </li>';
                                //<!-- END timeline item -->
                            }elseif(preg_match("/Elimin\b/", $respuesta[$i]["accion"])){
                                echo '<li>
                                    <i class="ion icon-trash bg-danger"></i>
                                    <div class="timeline-item card">
                                        <div class="card-header white"><h6>'.$respuesta[$i]["usuario"].' '.$respuesta[$i]["accion"].'    <span class="time float-right"><i class="ion icon-clock-o"></i> '.fechaHora($respuesta[$i]["fecha"]).'</span></h6></div>
                                    </div>
                                </li>';
                            }elseif(preg_match("/Modific\b/", $respuesta[$i]["accion"])){
                                echo '<li>
                                    <i class="ion icon-mode_edit bg-warning"></i>
                                    <div class="timeline-item card">
                                        <div class="card-header white"><h6>'.$respuesta[$i]["usuario"].' '.$respuesta[$i]["accion"].'    <span class="time float-right"><i class="ion icon-clock-o"></i> '.fechaHora($respuesta[$i]["fecha"]).'</span></h6></div>
                                    </div>
                                </li>';
                            } 
                        }
                    }
                }
            }
            ?>
        </div>
    </div>
</aside>
<!-- /.right-sidebar -->
<!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
<div class="control-sidebar-bg shadow white fixed"></div>
</div>
<!--/#app -->
<script src="assets/js/app.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>

    var infoDatos=[];

    $("#columnasSlide").css({"height":"100px"});
    if($("#columnasSlide").height() > 0){

        $("#columnasSlide").css({"height":"100px"});

    }

    else{

        $("#columnasSlide").css({"height":"auto"});

    }

    $("#columnasSlide").on("dragover", function(e){

        e.preventDefault();
        e.stopPropagation();

        $("#columnasSlide").css({"background":"url(assets/img/fondo_cuadros.png)"})

    })

    $("#columnasSlide").on("drop", function(e){

        e.preventDefault();
        e.stopPropagation();

        $("#columnasSlide").css({"background":"white"})

        var archivo = e.originalEvent.dataTransfer.files;
        var imagen = archivo[0];
        //console.log("imagen", imagen);

        // Validar tamaño de la imagen
        var imagenSize = imagen.size;
        
        if(Number(imagenSize) > 2000000){

            $("#columnasSlide").before('<div class="alert alert-warning alerta text-center">El archivo excede el peso permitido, 200kb</div>')

        }

        else{

            $(".alerta").remove();

        }

        // Validar tipo de la imagen
        var imagenType = imagen.type;
        
        if(imagenType == "image/jpeg" || imagenType == "image/png"){

            $(".alerta").remove();

        }

        else{

            $("#columnasSlide").before('<div class="alert alert-warning alerta text-center">El archivo debe ser formato JPG o PNG</div>')

        }

        //Subir imagen al servidor
        if(Number(imagenSize) < 2000000 && imagenType == "image/jpeg" || imagenType == "image/png"){

            //$("#denom").change(function(){
            //jalo el nombre del ID del Auto
            var nombre= document.getElementById("car_id").value;
            //})

            var datos = new FormData();

            datos.append("imagen", imagen);
            datos.append("nombre", nombre);

            $.ajax({
                url:"includes/gestorSlide.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                //dataType:"json",
                beforeSend: function(){

                    $("#columnasSlide").before('<div class="text-center height-100" id="status">'+
                        '<div class="preloader-wrapper big active">'+
                            '<div class="spinner-layer spinner-blue-only">'+
                                '<div class="circle-clipper left">'+
                                    '<div class="circle"></div>'+
                                '</div><div class="gap-patch">'+
                                '<div class="circle"></div>'+
                            '</div><div class="circle-clipper right">'+
                                '<div class="circle"></div>'+
                            '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>');

                },
                success: function(respuesta){

                    $("#status").remove();
                    
                    //if(respuesta == 0){

                        //$("#columnasSlide").before('<div class="alert alert-warning alerta text-center">La imagen es inferior a 1600px * 600px</div>')
                    
                    //}

                    //else{

                        infoDatos.push(respuesta);
                        //console.log("infoDatos", infoDatos);

                        $("#columnasSlide").css({"height":"auto"});

                        //$("#columnasSlide").append('<li class="bloqueSlide"><span class="icon-trash-can eliminarSlide"></span><img src="'+respuesta.slice(3)+'" class="handleImg"></li>');

                        $("#columnasSlide").append('<li class="bloqueSlide"><img src="'+respuesta.slice(3)+'" width="40%" class="handleImg"></li>');

                        swal("¡OK!", "¡La imagen se subió correctamente!", "success");

                        urlImagenes();

                    //}

                }

            });

        }

    });

    function urlImagenes(){
        var datosImages="";
        for (var i = 0; i < infoDatos.length; i++) {
            
            datosImages+=infoDatos[i];
            datosImages+="|";
        }
        document.getElementById("datosImagen").value=datosImages;
    }

    
</script>

</body>
</html>

<?php
}//termina else