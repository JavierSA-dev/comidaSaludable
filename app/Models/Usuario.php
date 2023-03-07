<?php

namespace App\Models;

class Usuario extends DBAbstractModel{
    private static $instancia;
    public static function getInstancia(){
        if(!isset(self::$instancia)){
            $miClase = __CLASS__;
            self::$instancia = new $miClase;
        }
        return self::$instancia;
    }

    private $id;
    private $user;
    private $passwd;
    private $updated_at;
    private $nombre;

    public function setUser($user){
        $this->user = $user;
    }

    public function setpasswd($passwd){
        $this->passwd = $passwd;
    }

    public function setUpdatedAt($updated_at){
        $this->updated_at = $updated_at;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function getId(){
        return $this->id;
    }

    public function getUser(){
        return $this->user;
    }

    public function getpasswd(){
        return $this->passwd;
    }

    public function getUpdatedAt(){
        return $this->updated_at;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function __clone(){
        trigger_error("La clonación no es permitida!", E_USER_ERROR);
    }

    public function getMensaje(){
        return $this->mensaje;
    }

    public function get(){
        // if($this->id != ''){
        //     $this->query = "SELECT * FROM usuarios WHERE id = :id";
        //     $this->parametros['id'] = $this->id;
        // }
        // $this->get_results_from_query();
        // return $this->rows;
    }

    public function set(){
        // $this->query = "INSERT INTO usuarios (user, passwd, updated_at, nombre) VALUES (:user, :passwd, :updated_at, :nombre)";
        // $this->parametros['user'] = $this->user;
        // $this->parametros['passwd'] = $this->passwd;
        // $this->parametros['updated_at'] = $this->updated_at;
        // $this->parametros['nombre'] = $this->nombre;
        // $this->get_results_from_query();
        // $this->mensaje = 'Usuario agregado exitosamente';
    }

    public function edit(){
        // $this->query = "UPDATE usuarios SET user = :user, passwd = :passwd, updated_at = :updated_at, nombre = :nombre WHERE id = :id";
        // $this->parametros['user'] = $this->user;
        // $this->parametros['passwd'] = $this->passwd;
        // $this->parametros['updated_at'] =  date("Y-m-d H:i:s");
        // $this->parametros['nombre'] = $this->nombre;
        // $this->get_results_from_query();
        // $this->mensaje = 'Usuario modificado exitosamente';
    }

    public function delete($id = ''){
        // $this->query = "DELETE FROM usuarios WHERE id = :id";
        // $this->parametros['id'] = $id;
        // $this->get_results_from_query();
        // $this->mensaje = 'Usuario eliminado exitosamente';
    }

    public function getUserByIdColaborador($idUsuario = ''){
        // select usuatios where id is idUsuario
        $this->query = "SELECT nombre FROM usuarios WHERE id = :id";
        $this->parametros['id'] = $idUsuario;
        $this->get_results_from_query();
        return $this->rows;
    }
    

}