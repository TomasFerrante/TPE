<?php
include_once 'app/views/album.views.php';
include_once 'app/models/tienda.de.musica.php';
class albumcontrollers{

    private $model;
    private $view;
  
  
   function __construct(){
       $this->model = new tiendademusica();
        $this->view = new albumviews();
  
      }
  
      function veralbum(){
  
        //VERIFICAR QUE EL USUARIO ESTA REGISTRADO
        $this->chequeoregistro();
       
       
          $albumes= $this->model->obtener();
          //OBTINEN LAS TAREAS DEL MODELO
           $this->view->mostraradmi($albumes);
           
           
              //ahora muestra las tareas desde la vista
  
      
      }
  
  
  
  function agregaralbum(){

    $nombre =  $_POST['nombre'];
    $canciones = $_POST['canciones'];
    $duracion = $_POST['duracion'];
    $artista = $_POST['artista'];
    $genero = $_POST['genero'];
    $lanzamiento = $_POST['lanzamiento'];
    
   
  
   $this->model->insertaralbum($nombre,$canciones,$duracion,$artista,$genero,$lanzamiento);
   header("Location:" . BASE_URL . "listar");
   
      
         
  }




  function chequeoregistro(){
      session_start();
        if (!isset($_SESSION['ID_USUARIO'])){
          header("Location: " . BASE_URL . "agregar");
          die();
        }
    }

    function verdetallado(){

      
        $items= $this->model->obtener();
          //OBTINEN LAS TAREAS DEL MODELO
           $this->view->mostrardetallado($items);
           
   
      
    }



    function borrar($id){
      $this->model->borrardatos($id);
      header('location:' . BASE_URL . "listar");
    
    }
    function editar($id){
        $this->model->editardatos($id);
        header('location:' . BASE_URL . "listar");
    }
}