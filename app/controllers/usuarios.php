<?php
include_once './app/models/user.model.php';
include_once './app/views/usuarios.views.php';
class usuarios {
    private $models;
    private $views;

    function __construct(){
        $this->models = new UserModel;
        $this->views= new usuariosviews();
   
        

    }

    
  function ver(){
    $items= $this->models->obtener();
    //$this->views->mostrardetallado($items);
 
  }
}