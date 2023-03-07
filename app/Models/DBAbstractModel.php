<?php

namespace App\Models;


abstract class DBAbstractModel
{
    private static $db_host = DBHOST;
    private static $db_user = DBUSER;
    private static $db_pass = DBPASS;
    private static $db_name = DBNAME;
    private static $db_port = DBPORT;

    protected $mensaje = '';
    protected $conn; // Manejador de la BD

    // Manejo basico de las consultas
    protected $query; // Consulta
    protected $parametros = array(); // Parametros de la consulta
    protected $rows = array(); // Resultado de la consulta

    // Manejo de transacciones
    abstract protected function get();
    abstract protected function set();
    abstract protected function edit();
    abstract protected function delete();

    public function getMessage()
    {
        return $this->mensaje;
    }

    private function open_connection()
    {
        $dns = 'mysql:host=' . self::$db_host . ';port=' . self::$db_port . ';dbname=' . self::$db_name;
        try {
            $this->conn = new \PDO($dns, self::$db_user, self::$db_pass, array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        } catch (\PDOException $e) {
            printf("Conexion fallida: %s\n", $e->getMessage());
            exit();
        }
    }

    #Método que devuelve el último id introducido.
    public function lastInsert()
    {
        return $this->conn->lastInsertId();
    }
    # Desconectar la base de datos
    private function close_connection()
    {
        $this->conn = null;
    }
    # Ejecutar un query simple del tipo INSERT, DELETE, UPDATE
    # Consulta que no devuelve tuplas de la tabla
    protected function execute_single_query()
    {
        if ($_POST) {
            $this->open_connection();
            // print_r($this->query);
            $this->conn->query($this->query);
            self:
            $this->close_connection();
        } else {
            $this->mensaje = 'Metodo no permitido';
        }
    }

    private function setMensaje($newMensaje)
    {
        $this->mensaje = $newMensaje;
    }

    protected function get_results_from_query()
    {
        $this->open_connection();
        $_result = false;
        if (($_stmt = $this->conn->prepare($this->query))) {
            if (preg_match_all('/(:\w+)/', $this->query, $_named, PREG_PATTERN_ORDER)) {
                $_named = array_pop($_named);
                foreach ($_named as $_param) {
                    $_stmt->bindValue($_param, $this->parametros[substr($_param, 1)]);
                }

            }
            try {
                if (!$_stmt->execute()) {
                    // printf("Error de consulta: %s\n", $_stmt->errorInfo()[2]);
                    $this->setMensaje("Error de consulta: %s\n", $_stmt->errorInfo()[2]);
                } else {
                    $this->setMensaje("Consulta exitosa");
                    $_result = true;
                }
                //$_result = $_stmt->fetchAll(PDO::FETCH_ASSOC);
                $this->rows = $_stmt->fetchAll(\PDO::FETCH_ASSOC);
                $_stmt->closeCursor();
            } catch (\PDOException $e) {
                // printf("Error en consulta: %s\n", $e->getMessage());
                $this->setMensaje("Error en consulta: %s\n", $e->getMessage());
                $_result = true;
            }
        }
        return $_result;
    }
}
