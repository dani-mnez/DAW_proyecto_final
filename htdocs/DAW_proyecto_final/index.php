<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="./styles/base_styles.css">
        <link rel="stylesheet" href="./styles/styles.css">
        <script type="text/javascript" src="./lib/scripts.js"></script>
        <script type="text/javascript" src="./lib/functions.js"></script>
    </head>
    <body>
        <nav id="main_menu" aria-label="Menú principal">
            <img src="https://upload.wikimedia.org/wikipedia/commons/a/ab/Logo_TV_2015.png" alt="Logo">
            <?php
                $connection = new mysqli("localhost", "root", "");

                $result = $connection->query("SELECT * FROM proyecto.pags");

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<a href=''>" . $row['nom_pag'] . "</a>";
                    }
                }
                $connection->close();
            ?>
        </nav>
        <nav id="side_menu" aria-label="Menú lateral">
            <?php
                $connection = new mysqli("localhost", "root", "");

                $result = $connection->query("SELECT * FROM proyecto.secciones");

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<a href=''>" . $row['Nombre'] . "</a>";
                    }
                }
                $connection->close();
            ?>
            <div id="bkg_sel"/>
        </nav>
    </body>
</html>