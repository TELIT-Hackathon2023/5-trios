<?php

class Db
{
    const LOCAL_SERVER = "localhost";
    const REMOTE_SERVER = "";

    const DEBUGGING = true;

    const LOCAL_CREDENTIALS = [
        "servername" => "127.0.0.1",
        "username" => "root",
        "password" => "",
        "dbName" => "parking_db"
    ];
    const REMOTE_CREDENTIALS = [
        "servername" => "sql4.webzdarma.cz",
        "username" => "parkingwzsk3546",
        "password" => ")f^O50O7#t(\$TZcHoHY3",
        "dbName" => "parkingwzsk3546"
    ];

    const LOCAL_DOMAIN = "localhost/";
    const REMOTE_DOMAIN = "";

    public $db;

    public $localhost;
    public $isLocalhost;
    public $isDebbuging = self::DEBUGGING;
    public $domain;
    public function __construct()
    {
        global $_SERVER;
        $this->localhost = true;
        $this->isLocalhost = $this->localhost;
        $servername = $this->localhost ? self::LOCAL_SERVER : self::REMOTE_SERVER;
        $domain = $this->localhost ? self::LOCAL_DOMAIN : self::REMOTE_DOMAIN;
        $this->domain = $domain;
        $credentials = $this->localhost ? self::LOCAL_CREDENTIALS : self::REMOTE_CREDENTIALS;

        // Connect to the database
        try {
            $this->db = new PDO("mysql:host=" . $credentials["servername"] . ";dbname=" . $credentials["dbName"], $credentials["username"], $credentials["password"]);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if (self::DEBUGGING) {
                echo "Connected successfully";
            }
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            echo "Please contact the administrator at info@shortly.sk";
        }
    }

    /**
     * Returns the db object.
     *
     * @return db The PDO object.
     */
    public function getDb()
    {
        return $this->db;
    }
}

$db = new Db();
$db = $db->getDb();
