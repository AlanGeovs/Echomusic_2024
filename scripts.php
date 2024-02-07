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
        var titulos = document.querySelectorAll('.titulo-proyecto-home h4');

        titulos.forEach(function(titulo) {
            // Verifica si la longitud del texto del título excede los 30 caracteres
            if (titulo.innerText.length > 30) {
                // Trunca el texto a 30 caracteres y añade puntos suspensivos
                titulo.innerText = titulo.innerText.substring(0, 30) + '...';
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