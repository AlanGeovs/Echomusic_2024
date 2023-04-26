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
    <div class="container-fluid my-3">
        <div class="row">
            <div class="col-md-8">
                <div class="card my-3 no-b">
                    <div class="card-body">
                        <div class="card-title">Todas las categorías</div>
                        <table id="datatable" class="table table-bordered table-hover data-tables"
                               data-options='{ "paging": false; "searching":false}'>
                            <thead>
                            <tr>
                                <th>Clase</th>
                                <th>Tipo</th>
                                <th>Título</th>
                                <th>Descripción</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $respuesta=Consultas::listarCategorias();
                                for ($i=0; $i < count($respuesta); $i++) { 
                                    echo "<tr id='fila".$respuesta[$i]["ID"]."'>";
                                        echo "<td>".$respuesta[$i]["CLASE"]."</td>";
                                        echo "<td>".$respuesta[$i]["TIPO"]."</td>";
                                        echo "<td>".$respuesta[$i]["TAG"]."</td>";
                                        echo "<td>".$respuesta[$i]["DESCRIPCION"]."</td>";
                                        echo "<td><i class='icon-mode_edit' style='cursor: pointer;' onclick='editarCategoria(".$respuesta[$i]["ID"].");'></i>";
                                            if ($_SESSION["tipoUsuario"]=="admin") {
                                                echo "<i class='icon-trash ml-2' style='cursor: pointer;' onclick='eliminarCategoria(".$respuesta[$i]["ID"].");'></i>";
                                            }
                                        echo "</td>";
                                    echo "</tr>";
                                }
                            ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Clase</th>
                                <th>Tipo</th>
                                <th>Título</th>
                                <th>Descripción</th>
                                <th></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                
            </div>
            <div class="col-md-4">
                <h3>Agregar nueva Categoría</h3>
                <hr>
                <p></p>
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="tipo" class="col-form-label">Tipo</label>
                            <select name="tipo" id="tipo" class="form-control">
                                <option value="PRODUCTOS">Productos</option>
                                <option value="SERVICIOS">Servicios</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="titulo" class="col-form-label">Título</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea class="form-control r-0" id="descripcion" name="descripcion" rows="3" placeholder="Descripción"></textarea>
                    </div>
                    <button type="button" onclick="guardarCategoria('<?php echo count($respuesta); ?>');" class="btn btn-primary"><i class="icon-save"></i> Guardar</button>
                </form>
                <hr>            
            </div>
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

    function guardarEditar(){
        var id = document.getElementById("idEditar").value;
        var tipo=document.getElementById("tipoEditar").value;
        var titulo=document.getElementById("tituloEditar").value;
        var desc=document.getElementById("descripcionEditar").value;

        var xmlhttp;
        if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari

            xmlhttp=new XMLHttpRequest();

        }else{// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
            xmlhttp.onreadystatechange=function(){
            if (xmlhttp.readyState==4 && xmlhttp.status==200){
                
                if (xmlhttp.responseText=="ok") {
                    var table = $('#datatable').DataTable();
                    var data = table.row("#fila"+id).data();
                    var nuevosDatos=[data[0],tipo,titulo,desc,data[4]];
                    table.row( "#fila"+id ).data( nuevosDatos ).draw();
                    $("#myModal").modal("hide");

                    swal({
                      title: "Exito!",
                      text: "Los cambios han sido guardados correctamente!",
                      icon: "success",
                      button: "Aceptar",
                    }); 
                }else if(xmlhttp.responseText=="error"){
                    swal({
                      title: "Error",
                      text: "Hubo un error al guardar cambios!",
                      icon: "error",
                      button: "Aceptar",
                    }); 
                }

                

            }
        }
        xmlhttp.open("POST","includes/editarCategoria_db.php",true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send("tipo="+tipo+"&titulo="+titulo+"&desc="+desc+"&id="+id);
    }

    function editarCategoria(id){
        var table = $('#datatable').DataTable();
        var data = table.row("#fila"+id).data();
        //console.log("data", data);
        document.getElementById("idEditar").value=id;
        document.getElementById("tipoEditar").value=data[1];
        document.getElementById("tituloEditar").value=data[2];
        document.getElementById("descripcionEditar").value=data[3];
        $("#myModal").modal();
    }

    function eliminarCategoria(id){
        var fila=$("#fila"+id);
        swal({
            title: "¿Deseas eliminar esta categoría?",
            text: "Una vez eliminado, no es posible recuperar el registro.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                swal("Esta categoría ha sido eliminada correctamente!", {
              icon: "success",
            })
                //$("#eliminar"+id).hide();
                $.ajax({
                    type: "POST",
                    url: "includes/eliminarCategoria_db.php",
                    data: {idd:id},
                    success: function(respuesta) {
                        var table = $('#datatable').DataTable();
                        table.row( "#fila"+id ).remove();
                           
                        // Draw once all updates are done
                        table.draw();
                    }
                })
            } else {
                swal("No se llevo a cabo la operación")
            }
        
        });
    }

    function guardarCategoria(total){
        var tipo=document.getElementById('tipo').value;
        var titulo=document.getElementById('titulo').value;
        var desc=document.getElementById('descripcion').value;

        var xmlhttp;
        if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari

            xmlhttp=new XMLHttpRequest();

        }else{// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }

            xmlhttp.onreadystatechange=function(){
            if (xmlhttp.readyState==4 && xmlhttp.status==200){

                var respuesta=xmlhttp.responseText;
                if (respuesta!="error") {
                    var datos=xmlhttp.responseText.split("|");
                    var id=datos[0];
                    var cols=[datos[1],datos[2],datos[3],datos[4],"<i class='icon-mode_edit'></i><i class='icon-trash ml-2'></i>"];
                    var table = $('#datatable').DataTable();
                    table.row.add(cols).draw().nodes().to$().attr("id", "fila"+id);

                    document.getElementById('tipo').value="";
                    document.getElementById('titulo').value="";
                    document.getElementById('descripcion').value="";
                }else{

                    swal ( "Oops" ,  "Hubo un error" ,  "error" );

                }

                

            }
        }

        xmlhttp.open("POST","includes/registrarCategoria_db.php",true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send("tipo="+tipo+"&titulo="+titulo+"&desc="+desc+"&total="+total);

    }
</script>

</body>
</html>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Editar Categoría</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form>
            <div class="form-row">
                <input type="hidden" id="idEditar" name="idEditar">
                <div class="form-group col-md-6">
                    <label for="tipoEditar" class="col-form-label">Tipo</label>
                    <input type="text" class="form-control" id="tipoEditar" name="tipoEditar" placeholder="Tipo">
                </div>
                <div class="form-group col-md-6">
                    <label for="tituloEditar" class="col-form-label">Título</label>
                    <input type="text" class="form-control" id="tituloEditar" name="tituloEditar" placeholder="Título">
                </div>
            </div>
            <div class="form-group">
                <label for="descripcionEditar">Descripción</label>
                <textarea class="form-control r-0" id="descripcionEditar" name="descripcionEditar" rows="3" placeholder="Descripción"></textarea>
            </div>
            <button type="button" onclick="guardarEditar();" class="btn btn-primary"><i class="icon-save"></i> Guardar</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        
      </div>

    </div>
  </div>
</div>

<?php
}//termina else