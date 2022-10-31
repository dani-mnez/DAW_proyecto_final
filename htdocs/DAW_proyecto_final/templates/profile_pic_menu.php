<nav id='profile_pic_menu'>
    <ul>
        <li><a href="">Perfil</a></li>
        <li><a href="/DAW_proyecto_final/templates/dashboard.php">Configuración</a></li>
        <li><a href="">Mensajes</a></li>
        <li><a href="">Feedback</a></li>
        <?php if(isset($_SESSION['user']) && unserialize($_SESSION['user'])->type == 'producer'): ?>
            <li><a href="">Panel de control</a></li>
        <?php endif; ?>
        <li><a href="">Ayuda</a></li>
        <li><a href="/DAW_proyecto_final/modules/logout_logic.php">Salir</a></li>
    </ul>
</nav>
