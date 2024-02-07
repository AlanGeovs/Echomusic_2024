<?php
session_start();

require_once "model/model.php";

if (!isset($_SESSION["id_user"])) {
    header("Location: index.php?error=2");
} else {
?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <?php require  'includes/favicon.php'; ?>
        <title>Admin | EchoMusic </title>
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
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>

                    <div class="spinner-layer spinner-red">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>

                    <div class="spinner-layer spinner-yellow">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>

                    <div class="spinner-layer spinner-green">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="app">
            <?php include "menu.php"; ?>
            <!-- nuevo diseño  -->
            <div class="container-fluid animatedParent animateOnce">
                <div class="animated fadeInUpShort go">
                    <div class="row my-3">
                        <div class="col-md-8 offset-md-2">

                            <form id="formRegistroUsuario" method="post" enctype="multipart/form-data">
                                <div class="card no-b">
                                    <div class="card-body">
                                        <h3 class="text-center">REGISTRAR CLIENTE</h3>
                                        <HR>
                                        <h5 class="card-title">ACERCA DEL CLIENTE</h5>
                                        <div class="form-row">
                                            <div class="col-md-12">


                                                <div class="form-row">
                                                    <div class="form-group col-md-4 m-0">
                                                        <label for="descripcion">Nombre (s)</label>
                                                        <input type="text" class="form-control input-control input-no-text" id="name" name="name" placeholder="Nombres" required>
                                                    </div>
                                                    <div class="form-group col-md-4 m-0">
                                                        <label for="descripcion">Apellido Paterno</label>
                                                        <input type="text" class="form-control input-control input-no-text" id="last_name" name="last_name" placeholder="Apellido paterno" required>
                                                    </div>
                                                    <div class="form-group col-md-4 m-0">
                                                        <label for="descripcion">Apellido Materno</label>
                                                        <input type="text" class="form-control input-control input-no-text" id="last_name_second" name="last_name_second" placeholder="Apellido materno" required>
                                                    </div>


                                                </div>

                                                <div class="form-group m-0">
                                                    <label for="dob" class="col-form-label s-12">Género</label>
                                                    <br>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="male" name="gender" class="custom-control-input">
                                                        <label class="custom-control-label" for="male">Hombre</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="female" name="gender" class="custom-control-input">
                                                        <label class="custom-control-label" for="female">Mujer</label>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-row mt-1">
                                            <div class="form-group col-md-4 m-0">
                                                <label for="email" class="col-form-label s-12"><i class="icon-envelope-o mr-2"></i>Email</label>
                                                <input type="text" class="form-control input-control input-no-text" id="email" name="email" placeholder="ej. correo@gmail.com">
                                            </div>

                                            <div class="form-group col-md-4 m-0">
                                                <label for="phone" class="col-form-label s-12"><i class="icon-phone mr-2"></i>Teléfono</label>
                                                <input type="text" class="form-control input-control input-no-text" id="phone" name="phone" placeholder="Número oficina o casa">
                                            </div>
                                            <div class="form-group col-md-4 m-0">
                                                <label for="mobile" class="col-form-label s-12"><i class="icon-mobile-phone mr-2"></i>Celular</label>
                                                <input type="text" class="form-control input-control input-no-text" id="mobile" name="mobile" placeholder="Celular o WhatsApp">
                                            </div>

                                        </div>
                                    </div>
                                    <hr>
                                    <div class="card-body">
                                        <h5 class="card-title">DIRECCIÓN</h5>
                                        <div class="form-row">

                                            <div class="form-group col-md-6 m-0">
                                                <label for="descripcion">Calle</label>
                                                <input type="text" class="form-control input-control input-no-text" id="address" name="address" placeholder="Calle" required>
                                            </div>
                                            <div class="form-group col-md-3 m-0">
                                                <label for="descripcion">Número Ext</label>
                                                <input type="text" class="form-control input-control input-no-text" id="num_ext" name="num_ext" placeholder="Número Ext" required>
                                            </div>
                                            <div class="form-group col-md-3 m-0">
                                                <label for="descripcion">Número Int</label>
                                                <input type="text" class="form-control input-control input-no-text" id="num_int" name="num_int" placeholder="Número Int">
                                            </div>
                                            <div class="form-group col-md-3 m-0">
                                                <label for="descripcion">CP</label>
                                                <input type="text" class="form-control input-control input-no-text" id="cp" name="cp" placeholder="Ej. 04630" required>
                                            </div>
                                            <div class="form-group col-md-3 m-0">
                                                <label for="descripcion">Colonia</label>
                                                <input type="text" class="form-control input-control input-no-text" id="town" name="town" placeholder="Colonia o Pueblo" required>
                                            </div>
                                            <div class="form-group col-md-3 m-0">
                                                <label for="descripcion">Ciudad</label>
                                                <input type="text" class="form-control input-control input-no-text" id="city" name="city" placeholder="Ciudad / Municipio" required>
                                            </div>

                                            <div class="form-group col-md-3 m-0">
                                                <label for="descripcion">Estado</label>
                                                <input type="text" class="form-control input-control input-no-text" id="state" name="state" placeholder="Estado" required>
                                            </div>

                                        </div>


                                    </div>
                                    <hr>
                                    <div class="card-body">
                                        <h5 class="card-title">DETALLES</h5>
                                        <div class="form-row">
                                            <div class="form-group col-md-4 m-0">
                                                <label for="descripcion">Descuentos en Libros </label>
                                                <select id="discounts_books" name="discounts_books" class="form-control select-control select-no-option" required>
                                                    <option value="0">Sin descuento</option>
                                                    <option value="5">5%</option>
                                                    <option value="10">10%</option>
                                                    <option value="15">15%</option>
                                                    <option value="20">20%</option>
                                                    <option value="25">25%</option>
                                                    <option value="30">30%</option>
                                                    <option value="35">35%</option>
                                                    <option value="40">40%</option>
                                                    <option value="45">45%</option>
                                                    <option value="50">50%</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4 m-0">
                                                <label for="descripcion">Descuentos en Biblias </label>
                                                <select id="discounts_bibles" name="discounts_bibles" class="form-control select-control select-no-option" required>
                                                    <option value="0">Sin descuento</option>
                                                    <option value="5">5%</option>
                                                    <option value="10">10%</option>
                                                    <option value="15">15%</option>
                                                    <option value="20">20%</option>
                                                    <option value="25">25%</option>
                                                    <option value="30">30%</option>
                                                    <option value="35">35%</option>
                                                    <option value="40">40%</option>
                                                    <option value="45">45%</option>
                                                    <option value="50">50%</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4 m-0">
                                                <label for="descripcion">Descuentos en Regalos </label>
                                                <select id="discounts_gifts" name="discounts_gifts" class="form-control select-control select-no-option" required>
                                                    <option value="0">Sin descuento</option>
                                                    <option value="5">5%</option>
                                                    <option value="10">10%</option>
                                                    <option value="15">15%</option>
                                                    <option value="20">20%</option>
                                                    <option value="25">25%</option>
                                                    <option value="30">30%</option>
                                                    <option value="35">35%</option>
                                                    <option value="40">40%</option>
                                                    <option value="45">45%</option>
                                                    <option value="50">50%</option>
                                                </select>
                                            </div>


                                            <div class="form-group col-md-4 m-0">
                                                <label for="descripcion">Tipo de usuario</label>
                                                <select id="type_user" name="type_user" class="form-control select-control select-no-option" required>
                                                    <option value=""> Seleccionar una opción</option>
                                                    <option id='0' name='0' value="0">Público en general</option>
                                                    <option id='1' name='1' value="1">Iglesias</option>
                                                    <option id='2' name='2' value="2">Patrocinio</option>
                                                    <option id='3' name='3' value="3">Seminarios</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4 m-0">
                                                <label for="descripcion">Cargo</label>
                                                <select id="position" name="position" class="form-control select-control select-no-option" required>
                                                    <option value=""> Seleccionar una opción</option>
                                                    <option id='1' name='1' value="1">Pastor (a)</option>
                                                    <option id='2' name='2' value="2">Líder</option>
                                                    <option id='3' name='3' value="3">Anciano</option>
                                                    <option id='4' name='4' value="4">Servidor (a)</option>
                                                    <option id='5' name='5' value="5">Diácono (a)</option>
                                                    <option id='6' name='6' value="6">Maestro (a)</option>
                                                    <option id='7' name='7' value="7">Asistente</option>
                                                    <option id='8' name='8' value="8">Responsable de librería</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4 m-0">
                                                <label for="descripcion">Notificaciones</label>
                                                <select id="notifications" name="notifications" class="form-control select-control select-no-option" required>
                                                    <option value=""> Seleccionar una opción</option>
                                                    <option id='0' name='0' value="1">Si</option>
                                                    <option id='1' name='1' value="2">No</option>
                                                </select>
                                            </div>

                                            <div class="col-md-12 mb-12">
                                                <label for="observaciones">Observaciones</label>
                                                <textarea class="form-control r-0" id="notes" name="notes" rows="5" class="form-control"></textarea>
                                            </div>

                                        </div>


                                    </div>
                                    <hr>
                                    <div class="card-body">
                                        <button class="btn btn-primary waves-effect" type="submit"><i class="icon-save mr-2"></i>Guardar</button>
                                        <button class="btn btn-danger waves-effect" type="reset"><i class="icon-trash mr-2"></i>Limpiar</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>




        <?php include 'right_sidebar_bitacora.php'; ?>

        <!--/#app -->
        <script src="assets/js/app.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <!-- JS para gaurdar datos de clientes -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('formRegistroUsuario').addEventListener('submit', function(e) {
                    e.preventDefault();

                    var formData = new FormData(this);

                    fetch('includes/registrarCliente_DB.php', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                swal("Registro exitoso", data.message, "success")
                                    .then((value) => {
                                        window.location.href =
                                            'listar_clientes.php'; // Redirigir al usuario
                                    });
                            } else {
                                swal("Error", data.message, "error");
                            }
                        })
                        .catch(error => {
                            swal("Error", "Error al procesar la solicitud: " + error, "error");
                        });
                });
            });
        </script>


        <script>
            var infoDatos = [];

            $("#columnasSlide").css({
                "height": "100px"
            });
            if ($("#columnasSlide").height() > 0) {

                $("#columnasSlide").css({
                    "height": "100px"
                });

            } else {

                $("#columnasSlide").css({
                    "height": "auto"
                });

            }

            $("#columnasSlide").on("dragover", function(e) {

                e.preventDefault();
                e.stopPropagation();

                $("#columnasSlide").css({
                    "background": "url(assets/img/fondo_cuadros.png)"
                })

            })

            $("#columnasSlide").on("drop", function(e) {
                e.preventDefault();
                e.stopPropagation();
                $("#columnasSlide").css({
                    "background": "white"
                })
                var archivo = e.originalEvent.dataTransfer.files;
                var imagen = archivo[0];

                //console.log("imagen", imagen);

                // Validar tamaño de la imagen
                var imagenSize = imagen.size;
                if (Number(imagenSize) > 2000000) {
                    $("#columnasSlide").before(
                        '<div class="alert alert-warning alerta text-center">El archivo excede el peso permitido, 200kb</div>'
                    )
                } else {
                    $(".alerta").remove();
                }

                // Validar tipo de la imagen
                var imagenType = imagen.type;
                if (imagenType == "image/jpeg" || imagenType == "image/png") {
                    $(".alerta").remove();
                } else {
                    $("#columnasSlide").before(
                        '<div class="alert alert-warning alerta text-center">El archivo debe ser formato JPG o PNG</div>'
                    )
                }

                //Subir imagen al servidor
                if (Number(imagenSize) < 2000000 && imagenType == "image/jpeg" || imagenType == "image/png") {

                    //$("#denom").change(function(){
                    //jalo el nombre del ID del Auto
                    var nombre = document.getElementById("car_id").value;
                    //})

                    var datos = new FormData();

                    datos.append("imagen", imagen);
                    datos.append("nombre", nombre);

                    $.ajax({
                        url: "includes/gestorSlide.php",
                        method: "POST",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        //dataType:"json",
                        beforeSend: function() {

                            $("#columnasSlide").before('<div class="text-center height-100" id="status">' +
                                '<div class="preloader-wrapper big active">' +
                                '<div class="spinner-layer spinner-blue-only">' +
                                '<div class="circle-clipper left">' +
                                '<div class="circle"></div>' +
                                '</div><div class="gap-patch">' +
                                '<div class="circle"></div>' +
                                '</div><div class="circle-clipper right">' +
                                '<div class="circle"></div>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>');

                        },
                        success: function(respuesta) {

                            $("#status").remove();

                            //if(respuesta == 0){

                            //$("#columnasSlide").before('<div class="alert alert-warning alerta text-center">La imagen es inferior a 1600px * 600px</div>')

                            //}

                            //else{

                            infoDatos.push(respuesta);
                            //console.log("infoDatos", infoDatos);

                            $("#columnasSlide").css({
                                "height": "auto"
                            });

                            //$("#columnasSlide").append('<li class="bloqueSlide"><span class="icon-trash-can eliminarSlide"></span><img src="'+respuesta.slice(3)+'" class="handleImg"></li>');

                            $("#columnasSlide").append('<li class="bloqueSlide"><img src="' + respuesta
                                .slice(3) + '" width="40%" class="handleImg"></li>');

                            swal("¡OK!", "¡La imagen se subió correctamente!", "success");

                            urlImagenes();

                            //}

                        }

                    });

                }

            });

            function urlImagenes() {
                var datosImages = "";
                for (var i = 0; i < infoDatos.length; i++) {

                    datosImages += infoDatos[i];
                    datosImages += "|";
                }
                document.getElementById("datosImagen").value = datosImages;
            }
        </script>


        <!-- Agrega un script JavaScript para cambiar las clases basado en el evento change del select: -->
        <script>
            document.addEventListener('DOMContentLoaded', (event) => {
                const selectElements = document.querySelectorAll('.select-control');
                const inputElements = document.querySelectorAll('.input-control');

                selectElements.forEach(selectElement => {
                    selectElement.addEventListener('change', (event) => {
                        if (selectElement.value === "") {
                            selectElement.classList.remove('select-has-option');
                            selectElement.classList.add('select-no-option');
                        } else {
                            selectElement.classList.remove('select-no-option');
                            selectElement.classList.add('select-has-option');
                        }
                    });
                });

                inputElements.forEach(inputElement => {
                    inputElement.addEventListener('input', (event) => {
                        if (inputElement.value.trim() === "") {
                            inputElement.classList.remove('input-has-text');
                            inputElement.classList.add('input-no-text');
                        } else {
                            inputElement.classList.remove('input-no-text');
                            inputElement.classList.add('input-has-text');
                        }
                    });
                });
            });
        </script>





    </body>

    </html>

<?php
}//termina else