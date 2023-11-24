<?php
include_once './app/models/ventas.model.php';
include_once './app/views/ventas.views.php';
include_once './app/models/album.model.php';

class VentasController {
    private $modelV;
    private $view;
    private $modelA;

    public function __construct() {
        $this->modelV = new VentasModel();
        $this->view = new VentasView();
        $this->modelA = new AlbumModel();
    }

    public function viewVentas() {
        $this->checkSession();
        $ventas = $this->modelV->getAll();
        $albumes = $this->modelA->getAll();
        $this->view->viewAdmin($ventas, $albumes);
    }

    public function addVenta() {
        $id_album = $_POST['id_album'];
        $via = $_POST['via'];
        $tipo = $_POST['tipo'];
        $precio = $_POST['precio'];
        
        $albumes = $this->modelA->getAll();

        if (empty($id_album) || empty($via) || empty($tipo) || empty($precio) || !$albumes) {
            $this->view->showError(); // Fallo la carga de datos
        }
        else {
            $this->modelV->insertVenta($id_album, $via, $tipo, $precio);
            header("Location:" . BASE_URL . "listarVentas");
        }
    }

    public function deleteVenta($id) {
        $this->modelV->deleteVenta($id);
        header("Location:" . BASE_URL . "listarVentas");
    }

    public function editVenta($id) {
        $id_album = $_POST['id_album'];
        $via = $_POST['via'];
        $tipo = $_POST['tipo'];
        $precio = $_POST['precio'];

        if (empty($id_album) || empty($via) || empty($tipo) || empty($precio)) {
            $this->view->showError(); // Fallo la carga de datos
        }
        else {
            $this->modelV->updateVenta($id, $id_album, $via, $tipo, $precio);
            header("Location:" . BASE_URL . "listarVentas");
        }
    }

    public function mostrarEditVenta($id) {
        $venta = $this->modelV->getById($id);
        $albumes = $this->modelA->getAll();
        $this->view->mostrarEditVenta($venta,$albumes);
    }

    function checkSession(){
        session_start();
          if (!isset($_SESSION['ID_USUARIO'])){
            header("Location: " . BASE_URL . "agregarVenta");
            die();
          }
      }
}
?>