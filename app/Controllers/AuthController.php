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
                $_SESSION['auth'] = $user->getPerfilByIdUser($_SESSION['id'])[0]['Perfiles_perfil'];
                header('Location: http://comidasaludable.localhost/');
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


}
?>