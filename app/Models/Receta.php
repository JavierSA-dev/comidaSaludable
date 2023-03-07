<?php

namespace App\Models;

class Receta extends DBAbstractModel{
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
    private $id;
    private $titulo;
    private $ingredientes;
    private $elaboracion;
    private $etiquetas;
    private $publica;
    private $imagen;
    private $idColaborador;


    public function setIdColaborador($idColaborador){
        $this->idColaborador = $idColaborador;
    }

    public function getIdColaborador(){
        return $this->idColaborador;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setTitulo($titulo){
        $this->titulo = $titulo;
    }

    public function setIngredientes($ingredientes){
        $this->ingredientes = $ingredientes;
    }

    public function setElaboracion($elaboracion){
        $this->elaboracion = $elaboracion;
    }

    public function setEtiquetas($etiquetas){
        $this->etiquetas = $etiquetas;
    }

    public function setPublica($publica){
        $this->publica = $publica;
    }

    public function setImagen($imagen){
        $this->imagen = $imagen;
    }

    public function getId(){
        return $this->id;
    }

    public function getTitulo(){
        return $this->titulo;
    }

    public function getIngredientes(){
        return $this->ingredientes;
    }

    public function getElaboracion(){
        return $this->elaboracion;
    }

    public function getEtiquetas(){
        return $this->etiquetas;
    }

    public function getPublica(){
        return $this->publica;
    }

    public function getImagen(){
        return $this->imagen;
    }

    public function get(){
        if($this->id != ''){
            $this->query = "SELECT * FROM recetas WHERE id = :id";
            $this->parametros['id'] = $this->id;
        }
        $this->get_results_from_query();
        return $this->rows;
    }

    public function getAll(){
        $this->query = "SELECT * FROM recetas";
        $this->get_results_from_query();
        return $this->rows;
    }

    // set 
    public function set(){
        $this->query = "INSERT INTO recetas (titulo, ingredientes, elaboracion, etiquetas, publica, imagen, idColaborador) VALUES (:titulo, :ingredientes, :elaboracion, :etiquetas, :publica, :imagen, :idColaborador)";
        $this->parametros['titulo'] = $this->titulo;
        $this->parametros['ingredientes'] = $this->ingredientes;
        $this->parametros['elaboracion'] = $this->elaboracion;
        $this->parametros['etiquetas'] = $this->etiquetas;
        $this->parametros['publica'] = $this->publica;
        $this->parametros['imagen'] = $this->imagen;
        $this->parametros['idColaborador'] = $this->idColaborador;
        $this->get_results_from_query();
        $this->mensaje = 'Receta agregada exitosamente';
    }

    public function edit(){
        $this->query = "UPDATE recetas SET titulo = :titulo, ingredientes = :ingredientes, elaboracion = :elaboracion, etiquetas = :etiquetas, publica = :publica, imagen = :imagen, idColaborador = :idColaborador WHERE id = :id";
        $this->parametros['titulo'] = $this->titulo;
        $this->parametros['ingredientes'] = $this->ingredientes;
        $this->parametros['elaboracion'] = $this->elaboracion;
        $this->parametros['etiquetas'] = $this->etiquetas;
        $this->parametros['publica'] = $this->publica;
        $this->parametros['imagen'] = $this->imagen;
        $this->parametros['idColaborador'] = $this->idColaborador;
        $this->parametros['id'] = $this->id;
        $this->get_results_from_query();
        $this->mensaje = 'Receta editada exitosamente';
    }
    
    public function delete(){
        $this->query = "DELETE FROM recetas WHERE id = :id";
        $this->parametros['id'] = $this->id;
        $this->get_results_from_query();
        $this->mensaje = 'Receta eliminada exitosamente';
    }
    
    public function getRows(){
        return $this->rows;
    }

    public function searchByTitulo($titulo){
        $this->query = "SELECT * FROM recetas WHERE titulo LIKE :titulo";
        $this->parametros['titulo'] = "%$titulo%";
        $this->get_results_from_query();
        return $this->rows;
    }

    // public function setId($id){
    //     $this->id = $id;
    // }

    // public function setNombre($nombre){
        //     $this->nombre = $nombre;
        // }

    // public function setVelocidad($velocidad){
    //     $this->velocidad = $velocidad;
    // }

    // public function getId(){
    //     return $this->id;
    // }

    // public function getNombre(){
    //     return $this->nombre;
    // }

    // public function getVelocidad(){
    //     return $this->velocidad;
    // }



    // public function getMensaje(){
    //     return $this->mensaje;
    // }

    // public function get(){
    //     if($this->id != ''){
    //         $this->query = "SELECT * FROM superheroes WHERE id = :id";
    //         $this->parametros['id'] = $this->id;
    //     }
    //     $this->get_results_from_query();
    //     return $this->rows;
    // }

    // public function set(){
    //     $this->query = "INSERT INTO superheroes (nombre, velocidad) VALUES (:nombre, :velocidad)";
    //     $this->parametros['nombre'] = $this->nombre;
    //     $this->parametros['velocidad'] = $this->velocidad;
    //     $this->get_results_from_query();
    //     $this->mensaje = "Superheroe agregado";
    // }

    // public function edit(){
    //     $this->query = "UPDATE superheroes SET nombre = :nombre, velocidad = :velocidad WHERE id = :id";
    //     $this->parametros['nombre'] = $this->nombre;
    //     $this->parametros['velocidad'] = $this->velocidad;
    //     $this->parametros['id'] = $this->id;
    //     $this->get_results_from_query();
    //     $this->mensaje = "Superheroe actualizado";
    // }

    // public function delete($id = ''){
    //     $this->query = "DELETE FROM superheroes WHERE id = :id";
    //     $this->parametros['id'] = $id;
    //     $this->get_results_from_query();
    //     $this->mensaje = "Superheroe eliminado";
    // }

    // public function search(){
    //     $this->query = "SELECT * FROM superheroes WHERE nombre LIKE :nombre";
    //     $this->parametros['nombre'] = "%".$this->nombre."%";
    //     $this->get_results_from_query();
    //     return $this->rows;
    // }
    

    // public function getAll(){
    //     $this->query = "SELECT * FROM superheroes";
    //     $this->get_results_from_query();
    //     return $this->rows;
    // }

    
}