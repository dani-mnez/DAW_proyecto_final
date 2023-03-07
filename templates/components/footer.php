            <nav id='footer'>
                <a href="#" id="to_top">Volver arriba</a>
                <div id="mid_footer">
                    <img id="footer_logo" src="/DAW_proyecto_final/assets/img/inv_logo.svg" alt="">
                    <div id="footer_links">
                        <ul>
                            <li class='title'>PRODUCTOS</li>
                            <?php
                                if ($prod_cat_qty) {
                                    foreach ($prod_cat_qty as $row) {
                                        echo "<li><a href='/DAW_proyecto_final/templates/cat_shop.php?cat_id=$row->_id'>{$row->name}</a></li>";
                                    }
                                }
                            ?>
                        </ul>
                        <ul>
                            <li class='title'>AYUDA</li>
                            <li><a href="/DAW_proyecto_final/templates/dashboard.php?page=messages">Atención al cliente</a></li>
                            <li><a href="/DAW_proyecto_final/templates/dashboard.php?page=profile">Mi cuenta</a></li>
                            <li><a href="/DAW_proyecto_final/templates/dashboard.php?page=orders">Estado del pedido</a></li>
                            <li><a href="/DAW_proyecto_final/templates/dashboard.php?page=feedback">Reclamaciones</a></li>
                        </ul>
                        <ul>
                            <li class='title'>PRODUCTORES</li>
                            <li><a href="/DAW_proyecto_final/templates/components/info/startselling.php">Empieza a vender</a></li>
                            <li><a href="/DAW_proyecto_final/templates/components/info/producertandcs.php">Condiciones del servicio</a></li>
                            <li><a href="/DAW_proyecto_final/templates/components/info/producercare.php">Atención a productores</a></li>
                        </ul>
                        <ul>
                            <li class='title'>INFORMACIÓN</li>
                            <li><a href="/DAW_proyecto_final/templates/components/info/shipping.php">Envíos y devoluciones</a></li>
                            <li><a href="/DAW_proyecto_final/templates/components/info/payment.php">Pagos</a></li>
                            <li><a href="/DAW_proyecto_final/templates/components/info/buyertandcs.php">Condiciones de compra</a></li>
                            <li><a href="/DAW_proyecto_final/templates/components/info/legal.php">Información legal</a></li>
                        </ul>
                        <ul>
                            <li class='title'>NOSOTROS</li>
                            <li><a href="/DAW_proyecto_final/templates/nosotros.php">El equipo</a></li>
                            <li><a href="/DAW_proyecto_final/templates/components/info/ourmission.php">Nuestra misión</a></li>
                            <li><a href="/DAW_proyecto_final/templates/components/info/rural.php">Información rural</a></li>
                            <li><a href="/DAW_proyecto_final/templates/components/info/infodo.php">Información D.O.</a></li>
                            <li><a href="/DAW_proyecto_final/templates/components/info/map.php">Mapa de productores</a></li>
                        </ul>
                        <ul>
                            <li class='title'>CONTACTO</li>
                            <li>Calle de Gabriel Usera, 54</li>
                            <li>28026, Madrid</li>
                            <li>Telf.: 96 623 424</li>
                            <li><mail>info@soldemarzo.com</mail></li>
                        </ul>
                    </div>
                </div>
                <div id="bottom_footer">
                    <p class="copy">© 2023 Soldemarzo. Todos los derechos reservados.</p>
                    <p class="credits">Hecho con ♥ por:&nbsp;
                        <a href="https://www.linkedin.com/in/aar%C3%B3n-fern%C3%A1ndez-moreno-3a37b3250/">Aarón Fernández</a>,&nbsp;
                        <a href="https://www.linkedin.com/in/catalinalauchan/">Catalina Lau Chan</a>,&nbsp;
                        <a href="https://www.linkedin.com/in/dani-mnez/">Dani Martínez</a>&nbsp;&&nbsp;
                        <a href="">Laura Gómez</a>.
                        <!-- TODO Laura ponte el link que quieras -->
                    </p>
                </div>
            </nav>
        </div>
        <script src="/DAW_proyecto_final/lib/late_scripts.js"></script>
    </body>
</html>
