<?php
include_once './app/views/album.views.php';
include_once './app/models/album.model.php';

class albumcontrollers{

    private $models;
    private $views;
  
  
   function __construct(){
        $this->models = new AlbumModel;
        $this->views = new albumviews();
  
      }
  
      function veralbum(){
  
        //VERIFICAR QUE EL USUARIO ESTA REGISTRADO
        $this->chequeoregistro();
       
       
          $albumes= $this->models->getAll();
          //OBTINEN LAS TAREAS DEL MODELO
           $this->views->mostraradmi($albumes);
           
           
              //ahora muestra las tareas desde la vista
  
      
      }
      
      function listado(){

        $items= $this->models->getAll();
        $this->views->mostrar($items);
        //OBTINEN LAS TAREAS DEL MODELO
     
        
    }
  
  
  
  function agregaralbum(){

    $nombre =  $_POST['nombre'];
    $canciones = $_POST['canciones'];
    $duracion = $_POST['duracion'];
    $artista = $_POST['artista'];
    $genero = $_POST['genero'];
    $lanzamiento = $_POST['lanzamiento'];
    
    
    if(empty($nombre) || empty($canciones) || empty($duracion)|| empty($genero)|| empty($lanzamiento)) {
    echo "no estan todos los datos";
  }else{
   $this->models->insertAlbum($nombre,$canciones,$duracion,$artista,$genero,$lanzamiento);
   header("Location:" . BASE_URL . "listar");
   
  }
         
  }
  public function editarItem($id){
    $nuevo = $_POST['editar'];

    if(empty($nuevo)) {
        //$this->views->showError("No se completaron todos los campos");
    } else {
        $this->views->editar($id);
        //$this->models->updateAlbum($id, $nuevo);
        header('Location: ' . BASE_URL . 'listar');
    }
}




  function chequeoregistro(){
      session_start();
        if (!isset($_SESSION['ID_USUARIO'])){
          header("Location: " . BASE_URL . "agregar");
          die();
        }
    }

    function verdetallado($id){

      
        $items= $this->models->getAlbumById($id);
          //OBTINEN LAS TAREAS DEL MODELO
           $this->views->mostrardetallado($items);
           
   
      
    }



    function borrar($id){
      $this->models->deleteAlbum($id);
      header('location:' . BASE_URL . "listar");
    
    }
    function editar($id){
      
      $nombre =  $_POST['nombre'];
      $canciones = $_POST['canciones'];
      $duracion = $_POST['duracion'];
      $artista = $_POST['artista'];
      $genero = $_POST['genero'];
      $lanzamiento = $_POST['lanzamiento'];
      
      
      if(empty($nombre) || empty($canciones) || empty($duracion)|| empty($genero)|| empty($lanzamiento)) {
      echo "no estan todos los datos";}
      else {
        $this->models->updateAlbum($id, $nombre, $canciones, $duracion, $artista, $genero, $lanzamiento);
        header('location:' . BASE_URL . "listar");
      }
    }

    function mostrarFormEdit($id) {
      $album = $this->models->getAlbumById($id);
      $this->views->mostrarFormEdit($album);


    }
}