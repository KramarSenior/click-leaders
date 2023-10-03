<?php

namespace Kramar\ClickLeaders;

use PDO;
use PDOException;

class Database
{
    public $connection;

    public function __construct() {
        $dbhost = "db";
        $dbuser = "root";
        $dbpass = "root";
        $port = "3306";

        $this->connection = new PDO("mysql:host=$dbhost;port=$port", $dbuser, $dbpass);
        $this->createDatabaseIfNotExists();
        $this->createTableIfNotExists();
    }

    public function query($query, $params = []) {
        $this->connection->query("USE clickleaders");;
        $stmt = $this->connection->prepare($query);
        $stmt->execute($params);

        return $stmt->fetch();
    }

    public function createDatabaseIfNotExists() {
        $this->connection->query("CREATE DATABASE IF NOT EXISTS clickleaders");
    }

    public function createTableIfNotExists() {
        $this->connection->query("USE clickleaders");
        $this->connection->query("
            CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                lastname VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL
            )
        ");
    }


}

