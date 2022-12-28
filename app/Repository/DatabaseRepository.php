<?php


namespace App\Repository;



namespace App\Repository;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;


class DatabaseRepository
{
    private static ?Connection $connection = null;

    public static function getConnection(): ?Connection
    {
        if (self::$connection == null) {
            $connectionParams = [
                'dbname' => "crypto-api",
                'user' => "root",
                'password' => "nishiki555",
                'host' => "localhost",
                'driver' => "pdo_mysql",
            ];
            self::$connection = DriverManager::getConnection($connectionParams);
        }
        return self::$connection;
    }
}