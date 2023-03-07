<?php

namespace App\Controllers;

use App\Models\Receta;
use App\Models\Usuario;

class RecetasController extends BaseController
{

    public function indexAction()
    {
        if (isset($_POST['auth'])) {
            AuthController::login($_POST);
        }else{
            $receta = Receta::getInstancia();
            $usuario = Usuario::getInstancia();
            $receta->getAll();
            $data = array('recetas' => $receta->getRows());
            // foreach ($data['recetas'] as $receta) {
            //     $data['recetas']['usuario'] =$usuario->getUserByIdColaborador($receta['idColaborador']);
            // }
            // print_r($data);
            $this->renderHTML('../views/index_view.php', $data);
        }
    }

    // public function addSuperheroeAction()
    // {
    //     if (!isset($_SESSION['auth']) or $_SESSION['auth'] != 'admin') {
    //         $this->renderHTML('../views/noAutorizado_view.php');
    //     }else{
    //         if (isset($_POST['send'])) {
    //             $superheroe = Superheroe::getInstancia();
    //             $superheroe->setNombre($_POST['nombre']);
    //             $superheroe->setVelocidad($_POST['velocidad']);
    //             $superheroe->set();
    //             header('Location: http://superheroes.localhost/');
    //         } else {
    //             $this->renderHTML('../views/addSuperheroe_view.php');
    //         }
    //     }

    // }

    // public function editSuperheroeAction($ruta)
    // {
    //     if (!isset($_SESSION['auth']) or $_SESSION['auth'] != 'admin') {
    //         $this->renderHTML('../views/noAutorizado_view.php');
    //     }else{
    //         if (isset($_POST['send'])) {
    //             $superheroe = Superheroe::getInstancia();
    //             $superheroe->setId($_POST['id']);
    //             $superheroe->setNombre($_POST['nombre']);
    //             $superheroe->setVelocidad($_POST['velocidad']);
    //             $superheroe->edit();
    //             header('Location: http://superheroes.localhost/');
    //         } else {
    //             $id = explode('/', $ruta)[2];
    //             $superheroe = Superheroe::getInstancia();
    //             $superheroe->setId($id);
    //             $superheroe->get();
    //             $data = array('superheroe' => $superheroe->getRows());
    //             if (empty($data['superheroe'])) {
    //                 $_SESSION['error'] = 'No existe el superheroe';
    //                 header('Location: http://superheroes.localhost/');
    //             }else{
    //                 $this->renderHTML('../views/editSuperheroe_view.php', $data);
    //             }
    //         }
    //     }

    // }

    // public function deleteSuperheroeAction($ruta)
    // {
    //     if (!isset($_SESSION['auth']) or $_SESSION['auth'] != 'admin') {
    //         $this->renderHTML('../views/noAutorizado_view.php');
    //     }else{
    //         $id = explode('/', $ruta)[2];
    //         $superheroe = Superheroe::getInstancia();
    //         $superheroe->delete($id);
    //         header('Location: http://superheroes.localhost/');
    //     }

    // }

    // public function searchAction()
    // {
    //     if (isset($_POST['searcher'])) {
    //         $superheroe = Superheroe::getInstancia();
    //         $superheroe->setNombre($_POST['nombre']);
    //         $superheroe->search();
    //         $data = array('superheroes' => $superheroe->getRows());
    //         $this->renderHTML('../views/index_view.php', $data);
    //     }else{
    //         header('Location: http://superheroes.localhost/');
    //     }

    // }
}
