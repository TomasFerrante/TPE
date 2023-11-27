<?php
include_once 'app/controllers/auth.controllers.php';
include_once 'app/controllers/usuarios.php';
include_once 'app/controllers/album.controllers.php';
include_once './app/controllers/ventas.controller.php';




define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'home'; // accion por defecto
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}



// listar->Obtenercargas();
$params = explode('/', $action);

switch ($params[0]) {
 
   case 'home':
    $controllers= new albumcontrollers();
    $controllers->listado();
    break;
   
   case 'login':
    $controller = new authcontrollers();
    $controller->iniciosesion();
    break;

   case 'verify':
    $controller = new authcontrollers();
    $controller->loginusuario();
    break;

   case 'administrar-ventas' :
    $controller = new VentasController();
    $controller->viewAdmin();
    break;

   case 'listar':
    $controller = new VentasController();
    $controller->viewAdmin();
    break;

   case 'logout':
    $controller = new authcontrollers();
    $controller->logout();
    break;

   case 'listarVentas':
    $controller = new VentasController();
    $controller->viewVentas();
    break;

   case 'agregarVenta':
    $controller = new VentasController();
    $controller->mostrarAddVenta();
    break;

   case 'addVenta' :
    $controller = new VentasController();
    $controller->addVenta();
    break;
   
   case 'agregar':
    $controller = new albumcontrollers();
    $controller->agregaralbum();
    break;

   case 'ver':
    $controller = new albumcontrollers();
    $controller->verdetallado($params[1]);
    break;

   case 'borrar':
    $controller = new albumcontrollers();
    $controller->borrar($params[1]);
    break;

   case 'borrarVenta' :
    $controller = new VentasController();
    $controller->deleteVenta($params[1]);
    break;
   
   case 'editar':
    $controller=new albumcontrollers();
    $controller->editar($params[1]);
    break;

   case 'editarVenta':
    $controller = new VentasController();
    $controller->editVenta($params[1]);
    break;

   case 'mostrarEditVenta' :
    $controller = new VentasController();
    $controller->mostrarEditVenta($params[1]);
    break;

   case 'mostraredit':
    $controllers = new albumcontrollers();
    $controllers->mostrarFormEdit($params[1]);
    break;

    default: 
    //CAMBIAR A ERRORES.PHTML
        echo "404 Page Not Found";
        break;
}