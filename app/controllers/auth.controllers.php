<?php

include_once 'app/views/auth.views.php';
include_once 'app/models/user.model.php';
include_once './app/helpers/auth.helper.php';

class authcontrollers{

    private $views;
    private $model;
    private $helper;

    public function __construct(){
        
        $this->views= new authviews();
        $this->model= new UserModel();
        $this->helper= new AutenticarHelper();
    }
    
    public function iniciosesion(){
        $this->views->iniciarsesion();
        
    }
    
    function initializeSession(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    public function loginusuario(){
        $username= $_POST['username'];
        $password= $_POST['password'];
        
        if(empty ($username)||empty($password)){
            $this->views->iniciarsesion('Faltan datos');
            return;
    }
     
          
        $user= $this->model->getByEmail($username);
         
        if($user && password_verify($password, $user->password) ){
            $this->initializeSession();
            $_SESSION['id'] = $user->id;
            $_SESSION['user'] = $user->username;
            header('Location: ' . BASE_URL . 'administrar-ventas');
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
    
    public function verificar() {
        $this->initializeSession();
        if(!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . 'login');
            die();
        }
    }
}