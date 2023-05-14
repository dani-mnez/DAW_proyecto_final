<?php include_once(__DIR__ . '/components/header.php'); ?>
<div id="content">
    <div id="producers_text">
        <h1>Orgullosos de nuestros productores</h1>
        <p>
            En Sol de Marzo, nos enorgullece trabajar de la mano con los valiosos productores rurales que confían en nuestro servicio. Son ellos quienes hacen posible ofrecer productos de calidad, con un sabor auténtico y una historia única detrás de cada uno.
        </p>
        <p>
            Nuestros productores son verdaderos guardianes de la tradición y el saber hacer. Con dedicación y pasión, cultivan la tierra, cuidan de sus animales y elaboran productos artesanales con métodos transmitidos de generación en generación. Cada uno de ellos representa una historia de esfuerzo, amor por su trabajo y un compromiso inquebrantable con la calidad.
        </p>
        <p>
            Trabajamos con pequeñas empresas rurales que se esfuerzan por preservar las técnicas tradicionales de cultivo y producción. Desde los olivares bañados por el sol hasta las bodegas enclavadas en hermosos paisajes, nuestros productores se dedican a ofrecer lo mejor de sus tierras y tradiciones en cada producto que llega a tu mesa.
        </p>
        <p>
            Al apoyar a estos productores rurales, estamos impulsando el desarrollo de sus comunidades locales. Cada compra realizada a través de nuestra plataforma contribuye a su crecimiento, permitiéndoles invertir en mejoras tecnológicas, capacitación y la preservación de sus tierras y tradiciones. De esta manera, juntos estamos fortaleciendo el entramado social y económico de nuestras zonas rurales.
        </p>
        <p>
            En Sol de Marzo, valoramos la diversidad y la variedad de nuestros productores. Desde los quesos artesanales elaborados con leche fresca hasta las frutas y verduras cultivadas con métodos ecológicos, cada uno de ellos aporta su propio toque distintivo a nuestra plataforma. Nos enorgullece ser el puente que une a estos productores con consumidores ávidos de descubrir nuevos sabores y experiencias.
        </p>
        <p>
            Gracias a nuestra red de productores rurales, podemos ofrecerte una amplia selección de productos frescos, auténticos y de alta calidad. Cada vez que eliges un producto de Sol de Marzo, estás respaldando a estos productores y contribuyendo a la preservación de su legado.
        </p>
    </div>
    <div id="producers_list">
        <?php
        $producers = $mongo_db->exec(
            "find",
            "producers",
            []
        )->toArray();

        foreach ($producers as $producer) {
            $address = $mongo_db->exec(
                'find_one',
                'addresses',
                ['_id' => $producer->adress]
            );

            require(__DIR__ . '/components/producer_card.php');
        }
        ?>
    </div>

</div>
<?php include_once(__DIR__ . '/components/footer.php'); ?>