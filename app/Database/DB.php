<?php
 
 namespace App\Database;

use Doctrine\DBAL\DriverManager;

class DB
{
    private $connection;

    public function __construct()
    {
        $this->connection = DriverManager::getConnection(include __DIR__ . '/../Config/database.php');
    }

    public function query()
    {
        return $this->connection->createQueryBuilder();
    }

    public function schema()
    {
        return $this->connection->createSchemaManager();
    }

    public function platform()
    {
        return $this->connection->getDatabasePlatform();
    }
}
