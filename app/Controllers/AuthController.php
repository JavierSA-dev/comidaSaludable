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
            $_SESSION['auth'] = 'admin';
            header('Location: http://cocinasaludable.localhost/');
        }else{
            $_SESSION['error'] = 'Usuario o contraseña incorrectos';
            header('Location: http://cocinasaludable.localhost/');
        }
    }
    public function logoutAction()
    {
        session_start();
        session_destroy();
        header('Location: http://cocinasaludable.localhost/');
    }


}
?>