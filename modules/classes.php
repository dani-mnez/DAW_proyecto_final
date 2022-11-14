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
        public string $dbName,
        public string $dbPort
    )
    {}

    private function connect($user = null, $password = null)
    {
        $conn = new mysqli(
            $this->server,
            $user ?? $this->user,
            $password ?? $this->password,
            $this->dbName,
            $this->dbPort
        );
        $conn->set_charset('utf8');

        return $conn;
    }

    public function execQuery(string $prepStmt, $values)
    {
        $con = $this->connect();

        $statement = $this->getStatement($prepStmt);

        if ($values != null) {
            $preparedStatement = $con->prepare($statement);  // Preparamos el statement para evitar inyecciones SQL
            $preparedStatement->bind_param($this->genTypeString($values), ...$values);  // Asignamos los valores a los parámetros del statement
            $preparedStatement->execute();  // Ejecutamos el statement
            $result = $preparedStatement->get_result()->fetch_all(MYSQLI_ASSOC);  // Obtenemos el resultado de la consulta -> la consulta devolverá un diccionario por linea

            $preparedStatement->close();  // Cerramos el statement
        } else {
            $result = $con->query($statement);
        }
        $con->close();  // Cerramos la conexión

        return $result;
    }

    private function genTypeString(array $values)
    {
        $typeString = '';
        foreach ($values as $value) {
            switch (gettype($value)) {
                case 'string':
                    $typeString .= 's';
                    break;
                case 'integer':
                    $typeString .= 'i';
                    break;
                case 'double':
                    $typeString .= 'd';
                    break;
                case 'blob':
                    $typeString .= 'b';
                    break;
                default:
                    $typeString .= 's';
                    break;
            }
        }

        return $typeString;
    }

    private function getStatement(string $statement)
    {
        return match ($statement) {
            'all_cat_prods' => 'SELECT DISTINCT `type` FROM `products` ORDER BY `qty` DESC',
            'all_prods' => 'SELECT * FROM `products`',
            'prod_detail' => 'SELECT * FROM `products` WHERE id=?',
            'cart_prods' => 'SELECT * FROM `cart_info` WHERE user_id=?',
            'chk_created_user' => 'SELECT mail, activated, password FROM users WHERE mail=? LIMIT 1', // El LIMIT es para que únicamente devuelva un resultado
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
    // TODO Crear función MANDAR MAIL
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
