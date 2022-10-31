<?php
// Clase con la que se gestionará toda la BBDD
class DBAccess
{
    # Darle seguridad a la conexión:
        # TODO Hashear los datos sensibles, como contraseñas y demás

    public function __construct(
        public string $server,
        public string $user,
        public string $password,
        public string $dbName
    )
    {}

    private function connect($user = null, $password = null)
    {
        if ($user == null || $password == null) {
            $user = $this->user;
            $password = $this->password;
        }

        try {
            $dsn = "mysql:dbname=$this->dbName;host=$this->server;charset=utf8";
            $dbGest = new PDO($dsn, $user, $password);
        } catch (PDOException $ex) {
            echo "Ha habido un error en el establecimiento de la conexión con la base de datos: " . $ex->getMessage();
        }

        return $dbGest;
    }

    public function execQuery(string $prepStmt, $query)
    {
        $con = $this->connect();
        $statement = $this->getStatement($prepStmt);

        if ($query) {
            $preparedStatement = $con->prepare($statement);
            $preparedStatement->execute($query);
            $result = $preparedStatement->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $result = $con->query($statement);
        }
        $con = null;
        return $result;
    }

    private function getStatement(string $statement)
    {
        return match ($statement) {
            'all_cat_prods' => 'SELECT DISTINCT `type` FROM `products` ORDER BY `qty` DESC',
            'all_prods' => 'SELECT * FROM `products`',
            // TODO Trabajarse esta query de abajo -> revisar apuntes
            'cart_prods' => 'SELECT products.name, products.price, products.type, products.prod_img_name, carts.prod_qty FROM (products INNER JOIN carts ON carts.prod_id = products.id) WHERE carts.user_id=?',
            'chk_created_user' => 'SELECT mail, password FROM users WHERE mail=? UNION SELECT mail, password FROM temp_users WHERE mail=?', // TODO Terminar esta consulta
            'insert_new_user' => 'INSERT INTO temp_users (mail, password, name, profile_img_path, mail_verification_code) VALUES (?, ?, ?, ?, ?)'
        };
    }
}

class User
{
    public function __construct(array $dataAsocArray)
    {
        $this->mail = $dataAsocArray['mail'];
        $this->name = $dataAsocArray['name'];
        $this->type = $dataAsocArray['type'];
        $this->phone = $dataAsocArray['phone'] ?? false;
        $this->img_path = $dataAsocArray['img_path'] ?? false;

        if ($dataAsocArray['location']) {
            $this->setDirection($dataAsocArray['location']);
        }
    }

    public function setDirection(string $direction)
    {
        if ($direction) {
            $dirArray = explode(";", $direction);

            $this->location = [
                "street_type" => $dirArray[0] ?? false,
                "street" => $dirArray[1] ?? false,
                "number" => $dirArray[2] ?? false,
                "floor" => $dirArray[3] ?? false,
                "postal_code" => $dirArray[4] ?? false,
                "city" => $dirArray[5] ?? false,
                "province" => $dirArray[6] ?? false
            ];
        }
    }

    // public function sendMail()
    // {

    // }
}

// OJO En principio, A DÍA DE HOY, no hay necesidad de utilizar clases hijas de la User
class Buyer extends User
{
    // OJO De momento no habría diferencia con la clase padre
    // más adelante se irán viendo implementaciones diferenciadas
    // private function __construct(
    //     private string $name,
    //     private string $mail
    // )
    // {
    //     parent::__construct($name, $mail);
    // }

    public function gatherBuyerInfo()
    {
        // TODO Obtener info de: pedidos, comentarios,
    }
}


class Producer extends User
{
    // OJO De momento no habría diferencia con la clase padre
    // más adelante se irán viendo implementaciones diferenciadas
    // private function __construct(
    //     private string $name,
    //     private string $mail
    //     )
    // {
    //     parent::__construct($name, $mail);
    // }
}
