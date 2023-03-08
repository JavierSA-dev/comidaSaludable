<?php
namespace App\Controllers;
use App\Models\Usuario;

class AuthController extends BaseController
{
    public static function login($data){
        $user = Usuario::getInstancia();
        $user->setUser($data['user']);
        $user->setpasswd($data['pass']);
        if ($user->exists()) {
            $_SESSION['user'] = $user->getUser();
            $_SESSION['name'] = $user->getNombre();
            $_SESSION['id'] = $user->getRows()[0]['id'];
            $_SESSION['estado'] = $user->isActivoByIdUser($_SESSION['id'])[0]['estado'];
            if ($_SESSION['estado'] == 'Bloqueado') {
                $_SESSION['error'] = 'Usuario bloqueado';
                header('Location: http://comidasaludable.localhost/');
            }else{
                $perfiles = $user->getPerfilByIdUser($_SESSION['id']);
                echo "<br>";
                $existe = false;
                foreach ($perfiles as $key => $value) {
                    if ($value['Perfiles_perfil'] == $_POST["perfil"]) {
                        $existe = true;
                    }
                }
                if ($existe) {
                    $_SESSION['auth'] = $_POST["perfil"];
                    print_r($_SESSION['auth']);
                    header('Location: http://comidasaludable.localhost/');
                }else{
                    $_SESSION['error'] = 'No tiene permisos para acceder a este perfil';
                    header('Location: http://comidasaludable.localhost/');
                }
            }
        }else{
            $_SESSION['error'] = 'Usuario o contraseña incorrectos';
            header('Location: http://comidasaludable.localhost/');
        }
    }
    public function logoutAction()
    {
        session_start();
        session_destroy();
        header('Location: http://comidasaludable.localhost/');
    }

    public static function getTiempoInactividadAction(){
        $user = Usuario::getInstancia();
        $tiempo = $user->getTiempoInactividad();
        return $tiempo;
    }

}
?>