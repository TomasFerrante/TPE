<?php

class VentasView {
    public function viewAdmin($item, $albumes) {
        require_once './templates/header.phtml';
        var_dump($albumes);
        require_once './templates/listadoVentas.phtml';
    }
}

?>