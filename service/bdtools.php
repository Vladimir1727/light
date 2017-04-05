<?php
/*Реализован паттерн Singleton*/
namespace diam\test;
use PDO as PDO;
class bdtools
{
    private static $_ins, $pdo;

    private function __construct()
    {
        try {
            $file = file_get_contents('config_db');
            $config = json_decode($file);
            $dsn = 'mysql:host='.$config->host.';dbname='.$config->database.';charset=utf8;';
            $options = array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'set names "utf8"',
                    );
            $this->pdo = new PDO($dsn, $config->login, $config->pass,$options);
        } catch (PDOException $Exception) {
            return false;
        }
    }

    static public function connect() {
        if (null === self::$_ins) {
            self::$_ins = new self();
            }
        return self::$_ins->pdo;
    }
}