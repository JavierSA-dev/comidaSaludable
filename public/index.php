<?php 
include '../vendor/autoload.php';

use Dotenv\Dotenv;
use App\Core\Router;
use App\Controllers\RecetasController;
use App\Controllers\AuthController;

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

define('DBHOST', $_ENV['DB_HOST']);
define('DBNAME', $_ENV['DB_NAME']);
define('DBUSER', $_ENV['DB_USER']);
define('DBPASS', $_ENV['DB_PASS']);
define('DBPORT', $_ENV['DB_PORT']);

session_start();
if (!isset($_SESSION['auth'])) {
    $_SESSION['auth'] = 'guest';
    $_SESSION['id'] = 0;
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
