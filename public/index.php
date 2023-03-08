<?php 
include '../vendor/autoload.php';

use Dotenv\Dotenv;
use App\Core\Router;
use App\Controllers\RecetasController;
use App\Controllers\AuthController;
use App\Core\Bootstrap;
// $dotenv = Dotenv::createImmutable(__DIR__ . '/..');
// $dotenv->load();

// define('DBHOST', $_ENV['DB_HOST']);
// define('DBNAME', $_ENV['DB_NAME']);
// define('DBUSER', $_ENV['DB_USER']);
// define('DBPASS', $_ENV['DB_PASS']);
// define('DBPORT', $_ENV['DB_PORT']);
Bootstrap::getEnvData();

session_start();
if (!isset($_SESSION['auth'])) {
    $_SESSION['auth'] = 'guest';
    $_SESSION['id'] = 0;
}

if (isset($_SESSION["estado"])) {
    if ($_SESSION["estado"] == "Bloqueado") {
        $_SESSION['error'] = 'Usuario bloqueado';
        header('Location: http://comidasaludable.localhost/');
    }
}

if (!isset($_SESSION['expiracion'])) {
    $_SESSION['expiracion'] = time() + AuthController::getTiempoInactividadAction()[0]['tiempoinactividad'];
}else{
    if (time() > $_SESSION['expiracion']) {
        session_destroy();
        header('Location: http://comidasaludable.localhost/');
    }else{
        $_SESSION['expiracion'] = time() + AuthController::getTiempoInactividadAction()[0]['tiempoinactividad'];
    }
}



$router = new Router();
$router->add(array(
    'name' => 'home',
    'path' => '/^\/$/',
    'action' => [RecetasController::class, 'IndexAction']
));

$router->add(array(
    'name' => 'addSuperheroe',
    'path' => '/add\/?$/',
    'action' => [RecetasController::class, 'addRecetaAction']
));

$router->add(array(
    'name' => 'editReceta',
    'path' => '/edit\/[0-9]*$/',
    'action' => [RecetasController::class, 'editRecetaAction']
));

$router->add(array(
    'name' => 'deleteReceta',
    'path' => '/delete\/[0-9]*$/',
    'action' => [RecetasController::class, 'deleteRecetaAction']
));

$router->add(array(
    'name' => 'search',
    'path' => '/search\/?$/',
    'action' => [RecetasController::class, 'searchAction']
));

$router->add(array(
    'name' => 'favoritos',
    'path' => '/favoritos\/?$/',
    'action' => [RecetasController::class, 'favoritoAction']
));

$router->add(array(
    'name' => 'generardocumento',
    'path' => '/generardocumento\/[0-9]*$/',
    'action' => [RecetasController::class, 'generardocumentoAction']
));

$router->add(array(
    'name' => 'logout',
    'path' => '/logout\/?$/',
    'action' => [AuthController::class, 'logoutAction']
));

$request = $_SERVER['REQUEST_URI'];

$route = $router->match($request);
if ($route) {
    $controllerName = $route['action'][0];
    $actionName = $route['action'][1];
    $controller = new $controllerName;
    $controller->$actionName($request);
} else {
    echo "No route";
}
