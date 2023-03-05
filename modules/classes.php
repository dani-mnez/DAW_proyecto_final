<?php
require_once(__DIR__ . '/../vendor/autoload.php'); // Include del plugin de mongo para PHP

class MongoDBAccess
{
    public function __construct(
        public string $server,
        public string $user,
        public string $password,
        public string $databaseName,
        public string $dbPort
    )
    {
        $this->client = new MongoDB\Client(
            "mongodb+srv://{$this->user}:{$this->password}@{$this->server}/?retryWrites=true&w=majority"
        );
    }

    public function exec($type, $collectionName, $searchParams)
    {
        $collection = $this->client->selectCollection($this->databaseName, $collectionName);

        switch ($type) {
            case 'find_one': $result = $collection->findOne($searchParams);  break;
            case 'find':     $result = $collection->find($searchParams);     break;
            case 'distinct': $result = $collection->distinct($searchParams); break;
            case 'count':    $result = $collection->count();                 break;
            case 'insert':                                                   break;
        case 'delete'                                                        break;
            default:         $result = null;                                 break;
        }

        return $result;
    }
}


class User
{
    public function __construct(array $dataAsocArray)
    {
        $this->id = $dataAsocArray['id'];
        $this->mail = $dataAsocArray['mail'];
        $this->name = $dataAsocArray['name'];
        $this->type = $dataAsocArray['type'];
        $this->phone = $dataAsocArray['phone'] ?? false;
        $this->prof_img = $dataAsocArray['prof_img'];

        if ($dataAsocArray['location']) {
            $this->setDirection($dataAsocArray['location']);
        }
    }

    public function setDirection(string $direction)
    {
        if ($direction) {
            $dirArray = explode(";", $direction);

            $this->location = [
                "type" => $dirArray[0] ?? false,
                "name" => $dirArray[1] ?? false,
                "number" => $dirArray[2] ?? false,
                "floor" => $dirArray[3] ?? false,
                "postal_code" => $dirArray[4] ?? false,
                "city" => $dirArray[5] ?? false,
                "province" => $dirArray[6] ?? false
            ];
        }
    }
    // TODO Crear función MANDAR MAIL

    public function addToCart()
    {
        
    }
}
