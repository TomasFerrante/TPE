<?php

include_once 'app/views/auth.views.php';
include_once 'app/models/user.model.php';
include_once './app/helpers/auth.helper.php';

class authcontrollers{

    private $views;
    private $model;

    public function __construct(){
        
        $this->views= new authviews();
        $this->model= new UserModel();
    }
    public function iniciosesion(){
        $this->views->iniciarsesion();
        
    }

    public function loginusuario(){
        $email=  $_POST['email'];
        $password= $_POST['password'];

        var_dump($_POST);
        
        if(empty ($email)||empty($password)){
            $this->views->iniciarsesion('Faltan datos');
            return;
        
        die();
    }
     
          //aca obtinen los datos del usuario
        $usuario= $this->model->getByEmail($email);
         //si el usuario existes
        if($usuario && password_verify($password, $usuario->password) ){
            
          
            //armo la session del usuario

            AutenticarHelper::login($usuario);

            header('Location: ' .BASE_URL. 'administrar');
        }
        else {
            $this->views->iniciarsesion('acceso denegado');
        }
        

        
    }
    public function error($error){
        $this->views->mostrarerror($error);
    }

    public function logout() {
        AutenticarHelper::logout();
        header('Location: ' .BASE_URL);
    }
    
}