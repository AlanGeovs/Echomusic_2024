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