<?php
include_once 'app/controllers/auth.controllers.php';
include_once 'app/controllers/usuarios.php';
include_once 'app/controllers/album.controllers.php';
include_once 'app/controllers/categorias.controllers.php';




define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'home'; // accion por defecto
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}



// listar->Obtenercargas();
$params = explode('/', $action);

switch ($params[0]) {
 
     case 'home';
     $controllers= new usuarios();
     $controllers->listado();
     break;
   
    case 'login';
    $controller = new authcontrollers();
    $controller->iniciosesion();
    break;
    case 'verify';
    $controller = new authcontrollers();
    $controller->loginusuario();
    break;
    case 'listar';
    $controller = new albumcontrollers();
   $controller->veralbum();
    case 'agregar';
   $controller = new albumcontrollers();
   $controller->agregaralbum();
   break;

   case 'ver';
   $controller = new albumcontrollers();
   $controller->verdetallado($params[1]);
   break;
   case 'borrar';
   $controller = new albumcontrollers();
   $controller->borrar($params[1]);
   break;
   case 'editar';
   $controller=new albumcontrollers();
  $controller->editar($params[1]);
   break;
   case 'categorias';
   $controller=new categoriascontrollers();
  $controller->vercategorias($params[1]);
   break;

    default: 
        echo "404 Page Not Found";
        break;
}