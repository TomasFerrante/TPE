<?php

class VentasView {
    public function viewAdmin($item, $albumes) {
        require_once './templates/header.phtml';
        require_once './templates/listadoVentas.phtml';
    }

    public function mostrarEditVenta($venta, $albumes) {
        require_once './templates/header.phtml';
        require_once './templates/editarVentas.phtml';
    }
}

?>