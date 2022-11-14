            <nav id='footer'>
                <a href="#" id="to_top">Volver arriba</a>
                <div id="footer_links">
                    <ul>
                        <li class='title'>PRODUCTOS</li>
                        <?php
                            $result = $db_access->execQuery('all_cat_prods', null);

                            if ($result) {
                                foreach ($result as $row) {
                                    echo "<a>{$row['type']}</a>";
                                }
                            }
                        ?>
                    </ul>
                    <ul>
                        <li class='title'>AYUDA</li>
                        <li><a href="">Atención al cliente</a></li>
                        <li><a href="">Mi cuenta</a></li>
                        <li><a href="">Estado del pedido</a></li>
                        <li><a href="">Reclamaciones</a></li>
                    </ul>
                    <ul>
                        <li class='title'>PRODUCTORES</li>
                        <li><a href="">Empieza a vender</a></li>
                        <li><a href="">Condiciones del servicio</a></li>
                        <li><a href="">Atención a productores</a></li>
                    </ul>
                    <ul>
                        <li class='title'>INFORMACIÓN</li>
                        <li><a href="">Envíos y devoluciones</a></li>
                        <li><a href="">Pagos</a></li>
                        <li><a href="">Condiciones de venta</a></li>
                        <li><a href="">Información legal</a></li>
                    </ul>
                    <ul>
                        <li class='title'>NOSOTROS</li>
                        <li><a href="">El equipo</a></li>
                        <li><a href="">Nuestra misión</a></li>
                        <li><a href="">Información rural</a></li>
                        <li><a href="">Información D.O.</a></li>
                        <li><a href="">Mapa de productores</a></li>
                    </ul>
                    <ul>
                        <li class='title'>CONTACTO</li>
                        <li>Calle de Gabriel Usera, 54</li>
                        <li>28026, Madrid</li>
                        <li>Telf.: 96 623 424</li>
                        <li><mail>info@soldemarzo.com</mail></li>
                    </ul>
                </div>
            </nav>
        </div>
        <script src="/DAW_proyecto_final/lib/late_scripts.js"></script>
    </body>
</html>
