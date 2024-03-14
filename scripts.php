<!-- Script migas de pan breadcrumb-->
<script>
    function onBackClick() {
        window.history.back();
    }
</script>

<!-- Newsletter -->
<script>
    // Newsletter
    $(document).ready(function() {
        $('.newsletter-form').on('submit', function(e) {
            e.preventDefault();
            var email = $('#emails').val();
            $.ajax({
                type: "POST",
                url: "includes/newsletter.php", // Asegúrate de que la ruta sea correcta
                data: {
                    email: email
                },
                success: function(response) {
                    // Ya no necesitas parsear JSON porque jQuery lo hace automáticamente si la respuesta tiene el header correcto
                    if (response.success == 1) { // Asegúrate de que este sea un entero
                        swal("¡Suscripción exitosa!", response.message, "success")
                            .then((value) => {
                                // window.location.href = 'algunaURL'; // Por sii se necesita redirigir
                                // Reseteo el form del news
                                $('.newsletter-form').trigger("reset");
                            });
                    } else {
                        swal("Error", response.message, "error");
                    }
                },
                error: function(xhr, status, error) {
                    swal("Error", "No se pudo procesar tu solicitud. Por favor, verifica tu conexión a internet y trata de nuevo.", "error");
                }
            });
        });
    });
</script>

<!-- Recorta titulos de Crowdfunding Home-->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Selecciona todos los elementos que contienen los títulos de los proyectos
        var titulos = document.querySelectorAll('.titulo-proyecto-home h3');

        titulos.forEach(function(titulo) {
            // Verifica si la longitud del texto del título excede los 30 caracteres
            if (titulo.innerText.length > 25) {
                // Trunca el texto a 30 caracteres y añade puntos suspensivos
                titulo.innerText = titulo.innerText.substring(0, 25) + '...';
            }
        });
    });
</script>

<!-- Recorta titulos de Crowdfunding -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Selecciona todos los elementos que contienen los títulos de los proyectos
        var titulos = document.querySelectorAll('.titulo-proyecto h3');

        titulos.forEach(function(titulo) {
            // Verifica si la longitud del texto del título excede los 45 caracteres
            if (titulo.innerText.length > 45) {
                // Trunca el texto a 45 caracteres y añade puntos suspensivos
                titulo.innerText = titulo.innerText.substring(0, 45) + '...';
            }
        });
    });
</script>

<!-- formulario de contacto -->
<script>
    document.getElementById('contacto').addEventListener('submit', function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        fetch('includes/enviaContacto_db.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    swal("¡Enviado!", data.message, "success");
                    // Limpia el formulario después de la alerta
                    document.getElementById('contacto').reset();
                } else {
                    swal("Error", data.message, "error");
                }
            })
            .catch(error => {
                console.error('Error: ', error);
                // Agregar una alerta aquí para informar al usuario de un error genérico
                swal("Error", "Ocurrió un error inesperado. Por favor, intenta nuevamente.", "error");
            });
    });
</script>

<!-- Envia pregunta de crowdfoundig -->
<script>
    document.getElementById('project_questions').addEventListener('submit', function(e) {
        e.preventDefault(); // Evitar el envío estándar del formulario

        var formData = new FormData(this); // Recoger los datos del formulario

        fetch('includes/enviaPreguntaCrowdfunding_bd.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    swal("¡Pregunta enviada!", data.message, "success");
                    document.getElementById('project_questions').reset(); // Limpiar formulario
                } else {
                    swal("Error", data.message, "error");
                }
            })
            .catch(error => {
                console.error('Error:', error);
                swal("Error", "No se pudo enviar tu pregunta. Por favor, intenta nuevamente.", "error");
            });
    });
</script>

<!-- Envia denuncia crowdfun -->
<script>
    document.getElementById('project_reports').addEventListener('submit', function(e) {
        e.preventDefault(); // Evitar el envío estándar del formulario

        var formData = new FormData(this); // Recoger los datos del formulario

        fetch('includes/enviaDenuncia_bd.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    swal("¡Reporte enviado!", data.message, "success");
                    $('#projectReportsModal').modal('hide'); // Ocultar modal
                    document.getElementById('project_reports').reset(); // Limpiar formulario
                } else {
                    swal("Error", data.message, "error");
                }
            })
            .catch(error => {
                console.error('Error:', error);
                swal("Error", "No se pudo enviar tu reporte. Por favor, intenta nuevamente.", "error");
            });
    });
</script>

<!-- Seleccionaa ambas fehcas de buscar en cartelera  -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var form = document.getElementById('formBusquedaCartelera');
        form.addEventListener('submit', function(e) {
            var fechaInicial = document.getElementById('fi').value;
            var fechaFinal = document.getElementById('ff').value;

            if ((fechaInicial !== '' && fechaFinal === '') || (fechaInicial === '' && fechaFinal !== '')) {
                e.preventDefault(); // Detiene el envío del formulario
                // Muestra una alerta con SweetAlert
                swal({
                    title: "Atención",
                    text: "Por favor, selecciona ambas fechas.",
                    icon: "warning",
                    button: "Aceptar",
                });
            }
            // Si ambas fechas están vacías, el formulario se envía normalmente
        });
    });
</script>


<script>
    function validaRut(rut) {
        // Eliminar puntos y guion
        var valor = rut.replace(/[.-]/g, '');

        // Aislar cuerpo y dígito verificador
        var cuerpo = valor.slice(0, -1);
        var dv = valor.slice(-1).toUpperCase();

        // Formatear RUN
        rut = cuerpo + '-' + dv;

        // Si no cumple con el mínimo ej. (n.nnn.nnn)
        if (cuerpo.length < 7) {
            return false;
        }

        // Calcular Dígito Verificador
        var suma = 0;
        var multiplo = 2;

        // Para cada dígito del cuerpo
        for (var i = 1; i <= cuerpo.length; i++) {
            // Obtener su producto con el módulo
            var index = multiplo * valor.charAt(cuerpo.length - i);

            // Sumar al contador general
            suma = suma + index;

            // Consolidar multiplicador
            if (multiplo < 7) {
                multiplo = multiplo + 1;
            } else {
                multiplo = 2;
            }
        }

        // Calcular Dígito Verificador en base al módulo 11
        var dvEsperado = 11 - (suma % 11);

        // Casos especiales (0 y K)
        dv = (dv == 'K') ? 10 : dv;
        dv = (dv == 0) ? 11 : dv;

        // Validar que el Cuerpo coincide con su Dígito Verificador
        if (dvEsperado != dv) {
            return false;
        }

        // Si todo está correcto
        return true;
    }

    // Evento de validación al perder el foco
    document.getElementById('rut').addEventListener('blur', function() {
        var rut = this.value;
        if (!validaRut(rut)) {
            // Mostrar error
            alert('RUT inválido. Por favor, intenta nuevamente.');
            this.classList.add('is-invalid');
        } else {
            // RUT válido
            this.classList.remove('is-invalid');
        }
    });
</script>