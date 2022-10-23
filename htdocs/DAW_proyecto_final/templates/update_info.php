<?php
include_once('../modules/classes.php');
session_start();

$street_type_pool = [
    "Alameda", "Calle", "Camino", "Carretera", "Glorieta", "Pasaje",
    "Paseo", "Plaza", "Rambla", "Ronda", "Sector", "Travesía",
    "Urbanización", "Avenida", "Barrio", "Campo", "Carrera", "Cuesta",
    "Edificio", "Jardines", "Parque", "Plazuela", "Placeta", "Poblado",
    "Via", "Bulevar", "Polígono", "Otros"
];

$province_pool = [
    "A Coruña", "Álava", "Albacete", "Alicante", "Almería", "Asturias",
    "Ávila", "Badajoz", "Baleares", "Barcelona", "Burgos", "Cáceres",
    "Cádiz", "Cantabria", "Castellón", "Ciudad Real", "Córdoba", "Cuenca",
    "Girona", "Granada", "Guadalajara", "Gipuzkoa", "Huelva", "Huesca", "Jaén",
    "La Rioja", "Las Palmas", "León", "Lérida", "Lugo", "Madrid", "Málaga",
    "Murcia", "Navarra", "Ourense", "Palencia", "Pontevedra", "Salamanca", "Segovia",
    "Sevilla", "Soria", "Tarragona", "Santa Cruz de Tenerife", "Teruel", "Toledo",
    "Valencia", "Valladolid", "Vizcaya", "Zamora", "Zaragoza", "Ceuta", "Melilla"
];

if (isset($_POST['dir_login_submit']) || isset($_POST['dir_contact_submit']) || isset($_POST['dir_update_submit'])) {
    $db_access = unserialize($_SESSION['db_acc']);
}
if (isset($_POST['dir_login_submit'])) {
    echo $query;
}

if (isset($_POST['dir_contact_submit'])) {
    echo $query;
}

if (isset($_POST['dir_update_submit'])) {
    $query = "{$_POST['street_type']};{$_POST['street']};{$_POST['number']};{$_POST['floor']};{$_POST['postal_code']};{$_POST['city']};{$_POST['province']}";
    echo $query;
}
?>

<html>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <fieldset>
        <legend>Información de login</legend>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email">

            <label for="pwd">Contraseña:</label>
            <input type="pwd" name="pwd" id="pwd">
            <input type="submit" name="dir_login_submit" value="Actualizar datos login">
        </fieldset>

        <fieldset>
            <legend>Información de contacto</legend>
            <label for="name">Nombre:</label>
            <input type="name" name="name" id="name">

            <label for="phone">Teléfono:</label>
            <input type="phone" name="phone" id="phone">
            <input type="submit" name="dir_contact_submit" value="Actualizar datos contacto">
        </fieldset>

        <fieldset>
            <legend>Dirección:</legend>
            <label for="street_type">Tipo de vía:</label>
            <select name="street_type" id="street_type">
                <?php
                    foreach ($street_type_pool as $type) {
                        echo "<option value=$type>$type</option>";
                    }
                ?>
            </select>
            <label for="street">Nombre vía:</label>
            <input type="text" name="street" id="street">
            <label for="number">Número:</label>
            <input type="text" name="number" id="number">
            <label for="floor">Piso:</label>
            <input type="text" name="floor" id="floor">
            <label for="postal_code">C.P.:</label>
            <input type="text" name="postal_code" id="postal_code">
            <label for="city">Población:</label>
            <input type="text" name="city" id="city">
            <label for="province">Provincia:</label>
            <select name="province" id="province">
                <?php
                    foreach ($province_pool as $type) {
                        echo "<option value=$type>$type</option>";
                    }
                ?>
            </select>
            <input type="submit" name="dir_update_submit" value="Actualizar datos dirección">
        </fieldset>
    </form>
</html>
