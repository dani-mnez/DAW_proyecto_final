<?php
// Clase con la que se gestionará toda la BBDD
class DBAccess
{
    public function __construct(
        public string $server,
        public string $user,
        public string $password,
        public string $dbName
    )
    {}

    private function connect()
    {
        $connection = new mysqli(
            $this->server,
            $this->user,
            $this->password,
            $this->dbName
        );
        $connection->set_charset("utf8");

        return $connection;
    }

    public function changeUser(string $user, string $password)
    {
        $conn = $this->connect();
        $conn->change_user($user, $password, $this->dbName);
        $conn->close();
    }

    public function execQuery(string $query)
    {
        $con = $this->connect();
        $result = $con->query($query);
        $con->close();

        return $result;
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
