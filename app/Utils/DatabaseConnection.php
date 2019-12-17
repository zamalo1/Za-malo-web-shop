<?php

namespace App\Utils;

class DatabaseConnection
{
    public static function getConnection()
    {
        $parameters = require "../env.php";
        $host=$parameters['host'];
        $db=$parameters['db_name'];
        $username=$parameters['db_user'];
        $password=$parameters['db_password'];
        $dsn= "mysql:host=$host;dbname=$db";
        $conn = new \PDO($dsn, $username, $password);
        return $conn;
    }

}