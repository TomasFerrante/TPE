<?php

class VentasView {
    public function viewAdmin($item, $albumes) {
        require_once './templates/header.phtml';
        require_once './templates/listadoVentas.phtml';
        require_once './templates/botonesAdmin.phtml';
    }

    public function mostrarEditVenta($venta, $albumes) {
        require_once './templates/header.phtml';
        require_once './templates/editarVentas.phtml';
    }

    public function viewVentas($item, $albumes) {
        require_once './templates/header.phtml';
        require_once './templates/listadoVentas.phtml';
    }
}

?>