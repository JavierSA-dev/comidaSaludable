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

    public function addRecetaAction()
    {
        $usuario = Usuario::getInstancia();
        
        if (!isset($_SESSION['auth']) or $_SESSION['auth'] != 'Collaborator' or $usuario->isActivoByIdUser($_SESSION['id'])[0]['estado'] == 'Bloqueado') {
            $_SESSION['estado'] = "Bloqueado";
            $this->renderHTML('../views/noAutorizado_view.php');
        }else{
            if (isset($_POST['send'])) {
                print_r($_FILES['imagen']);
                print_r($_POST);


                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
                $uploadOk = 1;
                $check = getimagesize($_FILES["imagen"]["tmp_name"]);
                if($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }

                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
                } else {
                    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
                        echo "The file ". basename( $_FILES["imagen"]["name"]). " has been uploaded.";
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }

                $receta = Receta::getInstancia();
                $receta->setTitulo($_POST['titulo']);
                $receta->setIngredientes($_POST['ingredientes']);
                $receta->setElaboracion($_POST['elaboracion']);
                $receta->setEtiquetas($_POST['etiquetas']);

                if (isset($_POST['publica'])) {
                    $receta->setPublica(1);
                }else{
                    $receta->setPublica(0);
                }
                $receta->setImagen($_FILES['imagen']['name']);
                $receta->setIdColaborador($_SESSION['id']);
                $receta->set();
                header('Location: http://comidasaludable.localhost/');
            } else {
                $this->renderHTML('../views/addReceta_view.php');
            }
        }

    }

    public function editRecetaAction($ruta)
    {
        $usuario = Usuario::getInstancia();
        if (!isset($_SESSION['auth']) or $_SESSION['auth'] != 'Collaborator' or $usuario->isActivoByIdUser($_SESSION['id'])[0]['estado'] == 'Bloqueado') {
            $_SESSION['estado'] = "Bloqueado";
            $this->renderHTML('../views/noAutorizado_view.php');
        }else{
            $id = explode('/', $ruta)[2];
            $receta = Receta::getInstancia();
            $receta->getById($id);
            $data = array('receta' => $receta->getRows()[0]);
            if (isset($_POST['send'])) {
                $target_dir = "uploads/";
                if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
                    $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
                    $uploadOk = 1;
                    $check = getimagesize($_FILES["imagen"]["tmp_name"]);
                    if($check !== false) {
                        echo "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        echo "File is not an image.";
                        $uploadOk = 0;
                    }
                    if ($uploadOk == 0) {
                        echo "Sorry, your file was not uploaded.";
                    } else {
                        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
                            echo "The file ". basename( $_FILES["imagen"]["name"]). " has been uploaded.";
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                        }
                    }
                    $receta->setImagen($_FILES['imagen']['name']);
                }else{
                    $receta->getById($id);
                    $data = array('receta' => $receta->getRows()[0]);
                    $receta->setImagen($data['receta']['imagen']);
                }

                $receta->setTitulo($_POST['titulo']);
                $receta->setIngredientes($_POST['ingredientes']);
                $receta->setElaboracion($_POST['elaboracion']);
                $receta->setEtiquetas($_POST['etiquetas']);
                if (isset($_POST['publica'])) {
                    $receta->setPublica(1);
                }else{
                    $receta->setPublica(0);
                }
                $receta->setIdColaborador($_SESSION['id']);
                $receta->edit($id);
                header('Location: http://comidasaludable.localhost/');
            } else {
                $this->renderHTML('../views/editReceta_view.php', $data);
            }
        }


    }

    public function deleteRecetaAction($ruta){
        $usuario = Usuario::getInstancia();
        if (!isset($_SESSION['auth']) or $_SESSION['auth'] != 'Collaborator' or $usuario->isActivoByIdUser($_SESSION['id'])[0]['estado'] == 'Bloqueado') {
            $_SESSION['estado'] = "Bloqueado";
            $this->renderHTML('../views/noAutorizado_view.php');
        }else{
            $id = explode('/', $ruta)[2];
            $receta = Receta::getInstancia();
            $receta->delete($id);
            header('Location: http://comidasaludable.localhost/');
        }
    }

    public function searchAction()
    {
        if (isset($_POST['searcher'])) {
            $receta = Receta::getInstancia();
            $receta->searchByTitulo($_POST['titulo']);
            $data = array('recetas' => $receta->getRows());
            $this->renderHTML('../views/index_view.php', $data);
        }else{
            header('Location: http://comidasaludable.localhost/');
        }
    }
}
