<?php
session_start();
require_once "model/model.php";

if (!isset($_SESSION["idUser"])) {
	header("Location: index.php?error=2");
}else{
	if (!isset($_GET["im"])) {
		header("Location: listar_marcas.php");
	}else{

	   $id=$_GET["im"];
    }//termina else isset($_GET["im"])
}//termina else isset($_SESSION["idUser"])

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
            height:auto;
            border:2px dashed #999;
        }

        #imgSlide ul li span{
            position:static;
            top:0;
            right:0;
            cursor:pointer;
            width:70px !important;
            height:70px !important;
            text-align:center;
            line-height:70px;
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
                    	<?php
                        	$respuesta=Consultas::detalleMarca($id);
                        	$respuesta["VIGENCIA"]=preg_replace('/([0-9]{4})\-([0-9]{2})\-([0-9]{2})/', "\\3-\\2-\\1", $respuesta["VIGENCIA"]);
                            $respuesta["ULTIMA_CERT_NOTARIAL"]=preg_replace('/([0-9]{4})\-([0-9]{2})\-([0-9]{2})/', "\\3-\\2-\\1", $respuesta["ULTIMA_CERT_NOTARIAL"]);
                        ?>
                        <h4>Modificar marca</h4> 
                        <form method="post" action="includes/editarMarca_db.php" class="form-material">
                        	<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id; ?>">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="denom">Denominación</label>
                                            <input type="text" class="form-control" id="denom" name="denom" value="<?php echo $respuesta["DENOM"]; ?>" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="titular">Titular</label>
                                            <input type="text" class="form-control" id="titular" name="titular" value="<?php echo $respuesta["TITULAR"]; ?>" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="paisOrigen">País de origen</label>
                                            <input type="text" class="form-control" id="paisOrigen" name="paisOrigen" value="<?php echo $respuesta["PAIS_ORI"]; ?>" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label for="numSol">No. Solicitnte</label>
                                            <input type="text" class="form-control" id="numSol" name="numSol" value="<?php echo $respuesta["NO_SOL"]; ?>" required>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="numRegistro">No. Registro</label>
                                            <input type="text" class="form-control" id="numRegistro" name="numRegistro" value="<?php echo $respuesta["NO_REG"]; ?>" required>
                                        </div>
                                        <div class="col-md-2 mb-3">                                
                                            <label for="vigencia">Vigencia</label>
                                            <div class="input-group">
                                                <input type="text" id="vigencia" name="vigencia" class="date-time-picker form-control"
                                                       data-options='{"timepicker":false, "format":"d-m-Y"}' value="<?php echo $respuesta["VIGENCIA"]; ?>"/>
                                                <span class="input-group-append">
                                                    <span class="input-group-text add-on white">
                                                        <i class="icon-calendar"></i>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label>Categorías</label>
                                            <select class="form-control" id="categoria" name="categoria">
                                            <?php
                                                $res=Consultas::listarClases();
                                                //var_dump($respuesta);
                                                for ($i=0; $i < count($res); $i++) { 
                                                    if ($res[$i]["ID"]==$respuesta["CLASE"]) {
                                                        echo "<option value='".$res[$i]["ID"]."' selected>".$res[$i]["TAG"]."</option>";
                                                    }else{
                                                        echo "<option value='".$res[$i]["ID"]."'>".$res[$i]["TAG"]."</option>";
                                                    }
                                                }
                                            ?> 
                                        
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label for="contacto">Contácto</label>
                                            <input type="text" class="form-control" id="contacto" name="contacto" value="<?php echo $respuesta["AUTORIZADOS"]; ?>">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="correo">Correo Electrónico</label>
                                            <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $respuesta["C_EMAIL"]; ?>">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="tel">Télefono</label>
                                            <input type="text" class="form-control" id="tel" name="tel" value="<?php echo $respuesta["C_TEL"]; ?>">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="fax">Fax</label>
                                            <input type="text" class="form-control" id="fax" name="fax" value="<?php echo $respuesta["C_FAX"]; ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="link">Link</label>
                                            <input type="text" class="form-control" id="link" name="link" value="<?php echo $respuesta["C_LINK"]; ?>">
                                            
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="fuente">Fuente</label>
                                            <input type="text" class="form-control" id="fuente" name="fuente" value="<?php echo $respuesta["URL_FUENTE"]; ?>">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="ult_certi_notarial">Última certificación notarial</label>
                                            <div class="input-group">
                                                <input type="text" id="ult_certi_notarial" name="ult_certi_notarial" class="date-time-picker form-control"
                                                       data-options='{"timepicker":false, "format":"d-m-Y"}'" value="<?php echo $respuesta["ULTIMA_CERT_NOTARIAL"]; ?>"/>
                                                <span class="input-group-append">
                                                    <span class="input-group-text add-on white">
                                                        <i class="icon-calendar"></i>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="prodServ">Servicio</label>
                                            <textarea class="form-control r-0" id="prodServ" name="prodServ" rows="5" required><?php echo $respuesta["PROD_SERV"]; ?></textarea>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="observaciones">Observaciones</label>
                                            <textarea class="form-control r-0" id="observaciones" name="observaciones" rows="5"><?php echo $respuesta["OBS"]; ?></textarea>
                                        </div>
                                    </div>
                                    <div id="imgSlide" class="row col-12">
                                        <p><span class="icon-arrow_downward"></span>  Arrastra aquí tu imagen, tamaño recomendado: 1600px * 600px</p>
        
                                        <ul id="columnasSlide" class="col-12">   
                                            <?php
                                            if ($respuesta["IMG"]!="") {
                                                if (preg_match("/|\b/", $respuesta["IMG"])) {
                                                    $images=explode("|", $respuesta["IMG"]);
                                                    for ($i=0; $i < count($images); $i++) { 
                                                        echo '<li id="'.$i.'" class="bloqueSlide col-6"><button class=" btn btn-danger btn-lg mr-2 eliminarSlide" ruta="'.$images[$i].'"><i class="icon-trash-can"></i></button><img src="'.substr($images[$i], 3).'" class="handleImg" width="40%"></li>';
                                                    }
                                                }else{
                                                    echo '<li id="'.$i.'" class="bloqueSlide col-6"><button class=" btn btn-danger btn-lg mr-2 eliminarSlide" ruta="'.$respuesta["IMG"].'"><i class="icon-trash-can"></i></button><img src="'.substr($respuesta["IMG"], 3).'" class="handleImg" width="40%"></li>';
                                                }
                                            }
                                            
                                            ?>
                                        </ul>
                                        <?php
                                        if ($respuesta["IMG"]!="") {
                                           echo '<textarea name="datosImagen" id="datosImagen" style="display: none;">'.$respuesta["IMG"].'|</textarea>'; 
                                        }else{
                                            echo '<textarea name="datosImagen" id="datosImagen" style="display: none;"></textarea>';
                                            
                                        }
                                        ?>
                                        
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary waves-effect" href="listar_marcas.php">Regresar</button>
                            <button class="btn btn-primary waves-effect" type="submit">Guardar</button>
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

    var imagenes=document.getElementById("datosImagen").value;
    //imagenes=imagenes.substring(0,imagenes.length -1);
    var infoDatos=imagenes.split("|");

    $("#columnasSlide").css({"height":"auto"});
    if(imagenes.length == 0){

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

            var imagenes=document.getElementById("datosImagen").value;
            var nombre=document.getElementById("denom").value;

            var datos = new FormData();

            datos.append("imagen", imagen);
            datos.append("imagenes", imagenes);
            datos.append("nombre", nombre);

            $.ajax({
                url:"includes/editarGestorSlide.php",
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

                        //infoDatos.push(respuesta);
                        //console.log("infoDatos", infoDatos);

                        var datos=respuesta.split("**");

                        $("#columnasSlide").css({"height":"auto"});

                        //$("#columnasSlide").append('<li class="bloqueSlide"><span class="icon-trash-can eliminarSlide"></span><img src="'+respuesta.slice(3)+'" class="handleImg"></li>');

                        //$("#columnasSlide").append('<li class="bloqueSlide"><img src="'+respuesta.slice(3)+'" class="handleImg"></li>');
                        $("#columnasSlide").html(datos[0]);
                        document.getElementById("datosImagen").value=datos[1]+"|";

                        swal("¡OK!", "¡La imagen se subió correctamente!", "success");

                        //urlImagenes();

                    //}

                }

            });

        }

    });

/*=============================================
Eliminar Item Slide
=============================================*/

$(".eliminarSlide").click(function(){

    if($(".eliminarSlide").length == 1){

        $("#columnasSlide").css({"height":"100px"});

    }

    idSlide = $(this).parent().attr("id");
    console.log("idSlide", idSlide);
    rutaSlide = $(this).attr("ruta");
    

    $(this).parent().remove();
    $("#item"+idSlide).remove();

    var imagenes=document.getElementById("datosImagen").value;

    var borrarItem = new FormData();

    borrarItem.append("idSlide", idSlide);
    borrarItem.append("rutaSlide", rutaSlide);
    borrarItem.append("imagenes",imagenes);

    $.ajax({

        url:"includes/editarGestorSlide.php",
        method: "POST",
        data: borrarItem,
        cache: false,
        contentType: false,
        processData: false,
        //dataType:"json",
        success: function(respuesta){
            //infoDatos.splice(idSlide,1);
            document.getElementById("datosImagen").value=respuesta;
            
            //urlImagenes();
            swal("¡OK!", "¡La imagen se ha eliminado correctamente!", "success");
        }

    })
})

/*=====  Eliminar Item Slide  ======*/

    function urlImagenes(){
        var datosImages="";
        for (var i = 0; i < infoDatos.length; i++) {
            //infoDatos.splice(idSlide,1);
            
            datosImages+=infoDatos[i];
            datosImages+="|";
        }

        document.getElementById("datosImagen").value=datosImages;
        //location.reload();
    }


    
</script>

</body>
</html>

