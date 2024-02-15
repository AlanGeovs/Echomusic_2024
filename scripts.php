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