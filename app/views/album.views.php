<?php
class albumviews{

function mostrar($items){
    require 'templates/header.phtml';


   

    require './templates/listado.phtml';
    
}
function mostrardetallado($items){
    require 'templates/header.phtml';
    require 'templates/mostrardetallado.phtml';
    
}
function mostraradmi($items){
    require 'templates/header.phtml';

    require 'templates/form.phtml';
   
  
    
}

    function mostrarFormEdit($album) {
        require 'templates/header.phtml';
        require_once './templates/editaritems.phtml';
    }
public function editar($id) {
    require 'templates/header.phtml';
    require 'templates/editaritems.phtml';
}

function mostrarcategorias($categorias){
    require 'templates/header.phtml';
    require 'templates/categorias.phtml';
}


}