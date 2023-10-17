<?php
include_once 'app/views/auth.views.php';
include_once 'app/models/usuarios.private.models.php';
class authcontrollers{

    private $views;
    private $model;

    public function __construct(){
        
        $this->views= new authviews();
        $this->model= new usuariosprivatemodels();
    }
    public function iniciosesion(){
        $this->views->iniciarsesion();
        
    }

    public function loginusuario(){
        $email=  $_POST['email'];
        $password= $_POST['password'];
        if(empty ($email)||empty($password)){
            $this->views->iniciarsesion('Faltan datos');
            return;
        
        die();
    }
     
          //aca obtinen los datos del usuario
        $usuario= $this->model->usuariosporemail($email);
         //si el usuario existes
        if($usuario && password_verify($password, $usuario->password) ){
            
          
            //armo la session del usuario

            session_start();
            $_SESSION['ID_USUARIO'] = $usuario->id;
            $_SESSION['EMAIL_USUARIO']= $usuario->email;

             header("Location:" . BASE_URL . "listar");
        }
        else {
            $this->views->iniciarsesion('acceso denegado');
        }
        

        
    }
    public function error($error){
        $this->View->mostrarerror($error);
    }
  
}