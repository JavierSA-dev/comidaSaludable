<?php
namespace App\Core;
use Dotenv\Dotenv;

class Bootstrap
{
    
    private static $instancia;
    public static function getInstancia(){
        if(!isset(self::$instancia)){
            $miClase = __CLASS__;
            self::$instancia = new $miClase;
        }
        return self::$instancia;
    }

    public function __clone(){
        trigger_error("La clonación no es permitida!", E_USER_ERROR);
    }

    public static function getEnvData(){
        $dotenv = Dotenv::createImmutable('../');
        $dotenv->load();
        define('DBHOST', $_ENV['DB_HOST']);
        define('DBNAME', $_ENV['DB_NAME']);
        define('DBUSER', $_ENV['DB_USER']);
        define('DBPASS', $_ENV['DB_PASS']);
        define('DBPORT', $_ENV['DB_PORT']);
        // define('KEY', $_ENV['KEY']);
    }

}
