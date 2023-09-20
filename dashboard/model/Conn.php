<?php

class Conn
{
    public static function conectar()
    {
        try {
            $dsn = 'mysql:host=localhost;dbname=echomusicnet_db;charset=utf8mb4';
            $username = 'echomusicnet_db';
            $password = 'W4dR9+L/Mi8';

            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            $link = new PDO($dsn, $username, $password, $options);
            return $link;
        } catch (PDOException $e) {
            error_log('Connection Error: ' . $e->getMessage());
            return null;
        }
    }
}
