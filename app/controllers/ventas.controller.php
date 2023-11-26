<?php
include_once './app/models/ventas.model.php';
include_once './app/views/ventas.views.php';
include_once './app/models/album.model.php';
include_once './app/controllers/auth.controllers.php';

class VentasController {
    private $modelV;
    private $view;
    private $modelA;
    private $helper;

    public function __construct() {
        $this->modelV = new VentasModel();
        $this->view = new VentasView();
        $this->modelA = new AlbumModel();
        $this->helper = new authcontrollers();
    }

    public function viewVentas() {
        $ventas = $this->modelV->getAll();
        $albumes = $this->modelA->getAll();
        $this->view->viewVentas($ventas, $albumes);
    }

    public function addVenta() {

        $id_album = $_POST['id_album'];
        
        $nombre_album = $_POST['nombre'];
        
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
            $this->helper->loginusuario();
                
                $venta = $this->modelV->getById($id);
                $albumes = $this->modelA->getAll();
                $this->view->mostrarEditVenta($venta,$albumes);
            }
            
            
            public function viewAdmin() {
                if ($this->helper->loginusuario()) {
                    $ventas = $this->modelV->getAll();
                    $albumes = $this->modelA->getAll();
                    $this->view->viewAdmin($ventas, $albumes);
                }
                else {
                    header('Location: ' .BASE_URL);
                }
                }
                
            
        }
    
    
    
    ?>