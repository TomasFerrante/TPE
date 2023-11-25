<?php
include_once './app/models/ventas.model.php';
include_once './app/views/ventas.views.php';
include_once './app/models/album.model.php';
include_once './app/helpers/auth.helper.php';

class VentasController {
    private $modelV;
    private $view;
    private $modelA;
    private $helper;

    public function __construct() {
        $this->modelV = new VentasModel();
        $this->view = new VentasView();
        $this->modelA = new AlbumModel();
        $this->helper = new AuthHelper();
    }

    public function viewVentas() {
        $ventas = $this->modelV->getAll();
        $albumes = $this->modelA->getAll();
        $this->view->viewVentas($ventas, $albumes);
    }

    public function addVenta() {
        if($this->helper->verify()) {

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
        else 
            header('location:' . BASE_URL . "login");
    }

    public function deleteVenta($id) {
        if ($this->helper->verify()) {
            $this->modelV->deleteVenta($id);
            header("Location:" . BASE_URL . "listarVentas");
        }
        else {
            header('location:' . BASE_URL . "login");
        }

    }

    public function editVenta($id) {
        if ($this->helper->verify()) {
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
        else {
            header('location:' . BASE_URL . "login");
        }

    }

    public function mostrarEditVenta($id) {
        if ($this->helper->verify()) {

        $venta = $this->modelV->getById($id);
        $albumes = $this->modelA->getAll();
        $this->view->mostrarEditVenta($venta,$albumes);
        }
        else {
            header('location:' . BASE_URL . "login");
        }
    }
}
?>