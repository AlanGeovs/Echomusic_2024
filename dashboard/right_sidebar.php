<?php
if ($_SESSION["tipoUsuario"] == "admin" or "cliente") {
?>
    <aside class="control-sidebar fixed white">
        <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 731px;">
            <div class="slimScroll" style="overflow: hidden; width: auto; height: 731px;">
                <div class="sidebar-header">
                    <h4>Carrito de compras</h4>
                    <a href="#" data-toggle="control-sidebar" class="paper-nav-toggle  active"><i></i></a>
                </div>
                <div class="table-responsive">
                    <?php
                    $productosCarrito = Carrito::obtenerProductosCarrito($idSesion);
                    $totalAPagar = 0;

                    echo '<table id="recent-orders" class="table table-hover mb-0 ps-container ps-theme-default">
                        <tbody>';

                    foreach ($productosCarrito as $producto) {
                        $subtotal = $producto['cantidad'] * $producto['price_public']; // Calcula el subtotal por producto
                        $totalAPagar += $subtotal; // Suma el subtotal al total a pagar
                        echo '<tr>
                            <td><a href="#">' . htmlspecialchars($producto['description']) . '</a> <small>' . htmlspecialchars($producto['cantidad']) . ' x $' . number_format($producto['price_public'], 2) . '</small></td>
                            <td>$' . number_format($subtotal, 2) . '</td> <!-- Muestra el subtotal de este producto -->
                        </tr>';
                    }

                    echo '    </tbody>
                    </table>';

                    // Muestra el total a pagar
                    echo '<h3 class="text-center">Total a pagar: $' . number_format($totalAPagar, 2) . '</h3>';

                    // Botón para ir al carrito
                    echo '<div class="text-center">
                        <a href="cart.php" class="btn btn-primary">Ver carrito</a>
                    </div>';
                    ?>

                    <!-- //AJAX para cargar dinámicamente los productos en la tabla del sidebar -->
                    <script>
                        $(document).ready(function() {
                            $('.nav-link[data-toggle="control-sidebar"]').on('click', function(e) {
                                e.preventDefault();

                                $.ajax({
                                    url: 'includes/obtenerProductosCarrito.php', // Ajusta esta ruta
                                    type: 'GET',
                                    dataType: 'json',
                                    success: function(data) {
                                        var tbody = $('#recent-orders tbody');
                                        tbody.empty(); // Limpia la tabla antes de agregar nuevos datos

                                        data.forEach(function(producto) {
                                            tbody.append(`
                        <tr>
                            <td><a href="#">${producto.description}</a></td>
                            <td><span class="badge badge-success">${producto.cantidad}</span></td>
                            <td>$ ${producto.price_public}</td>
                        </tr>
                    `);
                                        });
                                    },
                                    error: function(xhr, status, error) {
                                        console.error(error);
                                    }
                                });
                            });
                        });
                    </script>

                </div>

            </div>
            <div class="slimScrollBar" style="background: rgba(0, 0, 0, 0.95); width: 5px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 450.938px;"></div>
            <div class="slimScrollRail" style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>
        </div>
    </aside>
    <!-- /.right-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
                     immediately after the control sidebar -->
    <div class="control-sidebar-bg shadow white fixed"></div>

<?php
    //fin del else 
}
?>